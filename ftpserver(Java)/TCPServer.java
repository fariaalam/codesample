package ftpserver;
import java.io.*;
import java.net.*;
import javax.imageio.*;
import java.awt.*;
import java.awt.image.BufferedImage;
import com.sun.org.apache.xerces.internal.impl.dv.util.Base64;
class TCPServer {

    public static void main(String argv[]) throws Exception {
        String clientSentence;
        String capitalizedSentence;
      
        ServerSocket welcomeSocket = new ServerSocket(6789);
        System.out.println(welcomeSocket.isClosed());
        Socket connectionSocket[] = new Socket[4];
        BufferedReader inFromClient[] = new BufferedReader[4];
        DataOutputStream outToClient[] = new DataOutputStream[4];
        //while (true)
        for (int i = 0; i < 4; i++) {
            System.out.println("waiting\n ");
            connectionSocket[i] = welcomeSocket.accept();
            System.out.println("connected "+i);
            inFromClient[i] =
                    new BufferedReader(new InputStreamReader(
                    connectionSocket[i].getInputStream()));
            outToClient[i] =
                    new DataOutputStream(
                    connectionSocket[i].getOutputStream());
        }
         SThread[] connectionThread = new SThread[4];
       
     for(int j=0;j<4;j++){
         connectionThread[j] = new SThread(inFromClient[j],outToClient,j);
         
        }
        connectionThread[0].join();
        connectionThread[1].join();
        connectionThread[2].join();
        connectionThread[3].join();
        //A2B.join();
        //B2A.join();
    }
}
//===========================================================
class SThread extends Thread {

    BufferedReader inFromClient;
      BufferedReader fb=null;
    DataOutputStream[] outToClient;
    String clientSentence,fromFile,confirm="not authorized";
    int srcid,authorize;

    public SThread(BufferedReader in,DataOutputStream[] out,int a) {
        inFromClient = in;
        outToClient = out;
        srcid = a;
       authorize=0;
        start();
    }

    public void run() {
        
     while(true){  
        
        try{
          clientSentence=inFromClient.readLine();
          if(clientSentence.contains("-"))
          {
              if(authorization(clientSentence)==1)
              {
                  outToClient[srcid].writeBytes("Authorized"+'\n');
              }
              else
                  outToClient[srcid].writeBytes("Not Authorized"+'\n');
                  
          }
          else if(clientSentence.contains("getlist")){
              String a=getFile();
              //System.out.println(a);
              outToClient[srcid].writeBytes(a+'\n');
          }
          else if(clientSentence.contains(".txt")){
              String[] files=getFileArray();
              int src=-1;
              for(int i=0;i<files.length;i++)
              {
                  if(files[i].contains(clientSentence))
                  {
                      src=i;
                      break;
                  }
              }
              if(src!=-1&&!files[srcid].contains(clientSentence))
              {
                  String b=getContent(src);
                  outToClient[srcid].writeBytes(b+'\n');
                  files[srcid]=files[srcid]+" "+clientSentence;
                  editFile(files);
              }
              else if(src!=-1&&files[srcid].contains(clientSentence))
              {
                  outToClient[srcid].writeBytes("Duplicate File"+'\n');
              }
              else if(src==-1)
              {
                  outToClient[srcid].writeBytes("Unknown File"+'\n');
              }
              
          }
          else if(clientSentence.contains(".jpg")){
              String[] files=getFileArray();
              int src=-1;
              for(int i=0;i<files.length;i++)
              {
                  if(files[i].contains(clientSentence))
                  {
                      src=i;
                      break;
                  }
              }
              if(src!=-1&&!files[srcid].contains(clientSentence))
              {
                  String image=makeImageString(clientSentence,src);
                  outToClient[srcid].writeBytes(image+'\n');
                  outToClient[srcid].writeBytes(String.valueOf(srcid+1)+'\n');
                  files[srcid]=files[srcid]+" "+clientSentence;
                  editFile(files);
              }
              else if(src!=-1&&files[srcid].contains(clientSentence))
              {
                  outToClient[srcid].writeBytes("Duplicate Picture"+'\n');
              }
              else if(src==-1)
              {
                  outToClient[srcid].writeBytes("Unknown Picture"+'\n');
              }
          }
          else
          {
              outToClient[srcid].writeBytes("Unknown Command"+'\n');
          }
          
        
          
          
          
          
        }catch(Exception ex){
        }
        
    }
     
  }  
    
 public int authorization(String clientSentence) throws Exception{
      
         try {
                System.out.println("From Client "+ srcid+": " + clientSentence);
                fb = new BufferedReader(new FileReader("F:/fileprotocol/server/userpassword.txt"));
                  while ((fromFile = fb.readLine()) != null) {
                             if(fromFile.equals(clientSentence)){
                                 authorize=1;
                                 confirm="authorized";
				 System.out.println(confirm);
                               }
			}

                
               // clientSentence=clientSentence+"-"+String.valueOf(srcid);
               
                 
                //outToClient[srcid].writeBytes(confirm + '\n');	//'\n' is necessary
            } catch (Exception e) {
            }finally{
                if (fb != null)
                    fb.close();

             }
             
   
  return authorize;   
 }   
    
 public String getFile() throws Exception{
         String sentence="";
         try {
               int i=0;
                //System.out.println("From Client "+ srcid+": " + clientSentence);
                fb = new BufferedReader(new FileReader("F:/fileprotocol/server/filelist.txt"));
                  while ((fromFile = fb.readLine()) != null) {
                            if(i==0)
                             sentence=fromFile;
                            else
                               sentence=sentence+","+fromFile;
                            i++;
			}

                
               // clientSentence=clientSentence+"-"+String.valueOf(srcid);
               
                 
                //outToClient[srcid].writeBytes(confirm + '\n');	//'\n' is necessary
            } catch (Exception e) {
            }finally{
                if (fb != null)
                    fb.close();

             }
             
   
  return sentence;   
 }   
 
 public String[] getFileArray() throws Exception{
        String[] files=new String[4];
         try {
                int i=0;
                System.out.println("From Client "+ srcid+": " + clientSentence);
                fb = new BufferedReader(new FileReader("F:/fileprotocol/server/filelist.txt"));
                  while ((fromFile = fb.readLine()) != null) {
                             files[i]=fromFile;
                             i++;
			}
            } catch (Exception e) {
            }finally{
                if (fb != null)
                    fb.close();

             }
 
  return files;   
 }   
public String getContent(int src)throws Exception
{
    String content="";
    fb = new BufferedReader(new FileReader("F:/fileprotocol/client"+String.valueOf(src+1)+"/"+clientSentence));
    while ((fromFile = fb.readLine()) != null) {
        content=content+fromFile+":";     
    }
    content=content+String.valueOf(srcid+1);
    return content;
}
public void editFile(String files[])throws Exception
{
    int len=files.length;
    BufferedWriter bw = new BufferedWriter(new FileWriter("F:/fileprotocol/server/filelist.txt"));
    for (int i = 0; i <len; i++) {
        bw.write(files[i]);
        bw.newLine();
    } 
    bw.close();
}
public String makeImageString(String sentence,int src)throws Exception
{
        ByteArrayOutputStream b=new ByteArrayOutputStream(1000);
        BufferedImage img=ImageIO.read(new File("F:/fileprotocol/client"+String.valueOf(src+1)+"/"+sentence));
        ImageIO.write(img, "jpg", b);
        b.flush();
        String image=Base64.encode(b.toByteArray());
        b.close();
        return image;                            
}
 
}
//===========================================================

