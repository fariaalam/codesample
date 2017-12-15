package ftpserver;

import java.io.*;
import java.net.*;
import javax.imageio.*;
import java.awt.*;
import java.awt.image.BufferedImage;
import com.sun.org.apache.xerces.internal.impl.dv.util.Base64;
//============================================================

class TCPClient {

    public static void main(String argv[]) throws Exception {
        String modifiedSentence;

        InetAddress inetAddress = InetAddress.getLocalHost();
        //.getByName(String hostname); "CL11"
        System.out.println(inetAddress);

        Socket clientSocket = new Socket(inetAddress, 6789);
        DataOutputStream outToServer
                = new DataOutputStream(clientSocket.getOutputStream());

        BufferedReader inFromServer
                = new BufferedReader(new InputStreamReader(clientSocket.getInputStream()));

        CThread write = new CThread(inFromServer, outToServer, 0);
        

        write.join();
        
        clientSocket.close();
    }
}
//===================================================================

class CThread extends Thread {

    BufferedReader inFromServer;
    DataOutputStream outToServer;
    int RW_Flag;
    int verified=0;
    public CThread(BufferedReader in, DataOutputStream out, int rwFlag) {
        inFromServer = in;
        outToServer = out;
        RW_Flag = rwFlag;
        start();
    }

    public void run() {
        String sentence,id,pass;
        try {
                if(verified==0)
                {
                    BufferedReader inFromUser= new BufferedReader(new InputStreamReader(System.in));

                    System.out.println("Username : ");
                    id = inFromUser.readLine();
                    System.out.println("Password : ");
                    pass= inFromUser.readLine();
                    sentence=id+"-"+pass;
                    outToServer.writeBytes(sentence + '\n');
                    sentence = inFromServer.readLine();
                    System.out.println(sentence);
                    if(sentence.equals("Authorized"))
                        verified=1;
                    else
                        run();
                }
                BufferedReader inFromUser= new BufferedReader(new InputStreamReader(System.in));

                System.out.println("Keyword : ");
                sentence = inFromUser.readLine();
                String temp=sentence;
                if(sentence.equals("exit"))
                {
                    verified=0;
                    run();
                }
                outToServer.writeBytes(sentence+'\n');
                sentence=inFromServer.readLine();
                if(sentence.contains(",")){
                    String f[]=sentence.split(",");
                    for(int i=0;i<f.length;i++)
                    System.out.println(f[i]);
                }
                else if(sentence.contains(":"))
                {
                    String content[]=sentence.split(":");
                    int len=content.length;
                    BufferedWriter fb = new BufferedWriter(new FileWriter("F:/fileprotocol/client"+content[len-1]+"/"+temp));
                    for (int i = 1; i <len-1; i++) {
                        fb.write(content[i]);
                        fb.newLine();
                    }  
                    fb.close();
                    System.out.println("Transfer done");
                }
                else if(temp.endsWith(".jpg"))
                {
                    if(sentence.endsWith("Picture"))
                    {
                        System.out.println(sentence); 
                    }
                    else
                    {
                       String receiver=inFromServer.readLine();
                       byte[] ba = Base64.decode(sentence);
                       BufferedImage image=ImageIO.read(new ByteArrayInputStream(ba));
                       ImageIO.write(image, "jpg", new File("F:/fileprotocol/client"+receiver+"/"+temp));
                       System.out.println("Transfer done"); 
                    }
                }
                else
                   System.out.println(sentence); 
                run();     
         }
        catch (Exception e) {
            
        }
    }
    
}
//===================================================================
