
package bankmanagement;

import static bankmanagement.Client.inFromServer;
import static bankmanagement.Client.outToServer;
import static bankmanagement.Client.request;
import java.io.BufferedReader;
import java.io.DataOutputStream;


public class ClientMain extends javax.swing.JFrame implements Runnable {
    public static DataOutputStream outToServer;
    public static BufferedReader inFromServer;
    public String request="";
    public String id="";
    public String name="";
    public ClientMain(){
        
    }
    public ClientMain(DataOutputStream out,BufferedReader in,String id1,String name1) {
        outToServer=out;
        inFromServer=in;
        id=id1;
        name=name1;
        initComponents();
    }

    
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        exit = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        exit.setText("jButton1");
        exit.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                exitActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addContainerGap(317, Short.MAX_VALUE)
                .addComponent(exit)
                .addContainerGap())
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(javax.swing.GroupLayout.Alignment.TRAILING, layout.createSequentialGroup()
                .addContainerGap(266, Short.MAX_VALUE)
                .addComponent(exit)
                .addContainerGap())
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void exitActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_exitActionPerformed
        request="exit";
        run();
    }//GEN-LAST:event_exitActionPerformed

    
    public static void main(String args[]) {
        
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new ClientMain().setVisible(true);
            }
        });
    }
    public void run(){
        try{
            if(!request.equals(""))
            {
                outToServer.writeBytes(request+'\n');
            } 
            String abc="";//inFromServer.readLine();
            if(abc.contains("Authorized"))
            {
                String id=abc.split(":")[1];
                String name=abc.split(":")[2];
                ClientMain ab=new ClientMain(outToServer,inFromServer,id,name);
                ab.setVisible(true);
            }
            else if(abc.contains("Error"))
            {
                //jLabel3.setText(abc.split(":")[1]);
            }
        }
        catch(Exception e)
        {
            System.out.println(e.getMessage());
        }   
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    private javax.swing.JButton exit;
    // End of variables declaration//GEN-END:variables
}
