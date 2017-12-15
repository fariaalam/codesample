
package bankmanagement;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.io.ObjectOutputStream;
import java.net.ServerSocket;
import java.net.Socket;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.ArrayList;
import javax.swing.JOptionPane;
import javax.swing.table.DefaultTableModel;

public class Server extends javax.swing.JFrame { 
    public static ArrayList<String> currentUsers=new ArrayList<String>();
    static DefaultTableModel dmod;
    private static Connection connect = null;
    private static Statement statement = null;
    private static PreparedStatement preparedStatement = null;
    private static ResultSet resultSet = null;
    static String sentence[];
    static int i;
    public Server() {
        initComponents();
        loadUsers();
        loadCurrentUsers();
    }
    @SuppressWarnings("unchecked")
    // <editor-fold defaultstate="collapsed" desc="Generated Code">//GEN-BEGIN:initComponents
    private void initComponents() {

        jPanel1 = new javax.swing.JPanel();
        id = new javax.swing.JTextField();
        idButton = new javax.swing.JButton();
        name = new javax.swing.JTextField();
        nameButton = new javax.swing.JButton();
        showAll = new javax.swing.JButton();
        jScrollPane1 = new javax.swing.JScrollPane();
        users = new javax.swing.JTable();
        jLabel1 = new javax.swing.JLabel();
        jLabel2 = new javax.swing.JLabel();
        jScrollPane2 = new javax.swing.JScrollPane();
        history = new javax.swing.JTable();
        jScrollPane3 = new javax.swing.JScrollPane();
        current = new javax.swing.JTable();
        jLabel3 = new javax.swing.JLabel();
        historyButton = new javax.swing.JButton();

        setDefaultCloseOperation(javax.swing.WindowConstants.EXIT_ON_CLOSE);

        jPanel1.setBorder(javax.swing.BorderFactory.createTitledBorder(null, "Server Panel", javax.swing.border.TitledBorder.DEFAULT_JUSTIFICATION, javax.swing.border.TitledBorder.DEFAULT_POSITION, new java.awt.Font("Tahoma", 0, 14))); // NOI18N

        idButton.setText("Search By ID");
        idButton.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                idButtonActionPerformed(evt);
            }
        });
        nameButton.setText("Search By Name");
        nameButton.setActionCommand("");
        nameButton.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                nameButtonActionPerformed(evt);
            }
        });

        showAll.setText("Show All Users");
        showAll.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                showAllActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout jPanel1Layout = new javax.swing.GroupLayout(jPanel1);
        jPanel1.setLayout(jPanel1Layout);
        jPanel1Layout.setHorizontalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                    .addComponent(showAll, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                    .addGroup(jPanel1Layout.createSequentialGroup()
                        .addComponent(id, javax.swing.GroupLayout.PREFERRED_SIZE, 279, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addComponent(idButton, javax.swing.GroupLayout.PREFERRED_SIZE, 105, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addGap(18, 18, 18)
                .addComponent(name, javax.swing.GroupLayout.PREFERRED_SIZE, 279, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addGap(18, 18, 18)
                .addComponent(nameButton, javax.swing.GroupLayout.PREFERRED_SIZE, 105, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addContainerGap(javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
        );
        jPanel1Layout.setVerticalGroup(
            jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(jPanel1Layout.createSequentialGroup()
                .addGap(21, 21, 21)
                .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                    .addComponent(id)
                    .addGroup(jPanel1Layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                        .addComponent(idButton, javax.swing.GroupLayout.PREFERRED_SIZE, 38, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addComponent(name, javax.swing.GroupLayout.PREFERRED_SIZE, 40, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addComponent(nameButton, javax.swing.GroupLayout.PREFERRED_SIZE, 38, javax.swing.GroupLayout.PREFERRED_SIZE)))
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.RELATED)
                .addComponent(showAll, javax.swing.GroupLayout.DEFAULT_SIZE, 34, Short.MAX_VALUE)
                .addContainerGap())
        );

        users.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null},
                {null, null, null}
            },
            new String [] {
                "ID", "NAME", "AMOUNT"
            }
        ) {
            boolean[] canEdit = new boolean [] {
                false, false, true
            };

            public boolean isCellEditable(int rowIndex, int columnIndex) {
                return canEdit [columnIndex];
            }
        });
        users.setCellSelectionEnabled(true);
        users.getTableHeader().setResizingAllowed(false);
        users.getTableHeader().setReorderingAllowed(false);
        jScrollPane1.setViewportView(users);

        jLabel1.setFont(new java.awt.Font("Tahoma", 0, 14)); // NOI18N
        jLabel1.setText("Users");

        jLabel2.setFont(new java.awt.Font("Tahoma", 0, 14)); // NOI18N
        jLabel2.setText("Logged In Users");

        history.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null},
                {null, null, null, null, null}
            },
            new String [] {
                "OID ", "TYPE", "TRANSFERED TO", "AMOUNT", "DATE"
            }
        ));
        jScrollPane2.setViewportView(history);

        current.setModel(new javax.swing.table.DefaultTableModel(
            new Object [][] {
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null},
                {null, null}
            },
            new String [] {
                "ID", "NAME"
            }
        ));
        jScrollPane3.setViewportView(current);

        jLabel3.setFont(new java.awt.Font("Tahoma", 0, 14)); // NOI18N
        jLabel3.setText("History");

        historyButton.setText("Show History");
        historyButton.setActionCommand("");
        historyButton.addActionListener(new java.awt.event.ActionListener() {
            public void actionPerformed(java.awt.event.ActionEvent evt) {
                historyButtonActionPerformed(evt);
            }
        });

        javax.swing.GroupLayout layout = new javax.swing.GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setHorizontalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addContainerGap()
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jPanel1, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE)
                        .addContainerGap())
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING, false)
                            .addComponent(jScrollPane1, javax.swing.GroupLayout.DEFAULT_SIZE, 326, Short.MAX_VALUE)
                            .addComponent(jLabel1)
                            .addComponent(historyButton, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, Short.MAX_VALUE))
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jScrollPane2, javax.swing.GroupLayout.DEFAULT_SIZE, 652, Short.MAX_VALUE)
                            .addGroup(layout.createSequentialGroup()
                                .addComponent(jLabel3)
                                .addGap(0, 0, Short.MAX_VALUE)))
                        .addGap(18, 18, 18)
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                            .addComponent(jScrollPane3, javax.swing.GroupLayout.PREFERRED_SIZE, 309, javax.swing.GroupLayout.PREFERRED_SIZE)
                            .addComponent(jLabel2))
                        .addGap(19, 19, 19))))
        );
        layout.setVerticalGroup(
            layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
            .addGroup(layout.createSequentialGroup()
                .addGap(21, 21, 21)
                .addComponent(jPanel1, javax.swing.GroupLayout.PREFERRED_SIZE, javax.swing.GroupLayout.DEFAULT_SIZE, javax.swing.GroupLayout.PREFERRED_SIZE)
                .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.BASELINE)
                    .addComponent(jLabel1)
                    .addComponent(jLabel2)
                    .addComponent(jLabel3))
                .addGap(16, 16, 16)
                .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.LEADING)
                    .addGroup(layout.createSequentialGroup()
                        .addComponent(jScrollPane1, javax.swing.GroupLayout.PREFERRED_SIZE, 349, javax.swing.GroupLayout.PREFERRED_SIZE)
                        .addPreferredGap(javax.swing.LayoutStyle.ComponentPlacement.UNRELATED)
                        .addComponent(historyButton, javax.swing.GroupLayout.DEFAULT_SIZE, 34, Short.MAX_VALUE))
                    .addGroup(layout.createSequentialGroup()
                        .addGroup(layout.createParallelGroup(javax.swing.GroupLayout.Alignment.TRAILING, false)
                            .addComponent(jScrollPane3, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.DEFAULT_SIZE, 380, Short.MAX_VALUE)
                            .addComponent(jScrollPane2, javax.swing.GroupLayout.Alignment.LEADING, javax.swing.GroupLayout.PREFERRED_SIZE, 0, Short.MAX_VALUE))
                        .addGap(0, 0, Short.MAX_VALUE)))
                .addContainerGap())
        );

        pack();
    }// </editor-fold>//GEN-END:initComponents

    private void historyButtonActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_historyButtonActionPerformed
            try{
                if(users.getSelectedRow()!=-1)
                {
                    String id=users.getValueAt(users.getSelectedRow(), 0).toString();
                    Class.forName("com.mysql.jdbc.Driver");
                    connect = DriverManager.getConnection("jdbc:mysql://127.0.0.1/bankmanagement?user=root");
                    preparedStatement = connect.prepareStatement("select*from history where uid="+id);
                    resultSet = preparedStatement.executeQuery();
                    DefaultTableModel dmod=(DefaultTableModel)history.getModel();
                    while(dmod.getRowCount()>0)
                    {
                        for(int j=0;j<dmod.getRowCount();j++)
                            dmod.removeRow(j);
                    }
                    dmod.setRowCount(22);
                    int row=0;
                    while(resultSet.next())
                    {
                        history.setValueAt(resultSet.getString("oid"),row,0);
                        history.setValueAt(resultSet.getString("type"),row,1);
                        history.setValueAt(resultSet.getString("tran_to"),row,2);
                        history.setValueAt(resultSet.getString("amount"),row,3);
                        history.setValueAt(resultSet.getString("date"),row,4);
                        row++;
                    }
                }
                else{
                    JOptionPane.showMessageDialog(rootPane, "Please Select An User");
                }
            }
            catch(Exception e){
                System.out.println(e.getMessage());
            }   
             
    }//GEN-LAST:event_historyButtonActionPerformed

    private void idButtonActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_idButtonActionPerformed
        try{
            if(!id.getText().trim().equals(""))
            {
                String id1=id.getText();
                Class.forName("com.mysql.jdbc.Driver");
                connect = DriverManager.getConnection("jdbc:mysql://127.0.0.1/bankmanagement?user=root");
                preparedStatement = connect.prepareStatement("select*from users where ID='"+id1+"'");
                resultSet = preparedStatement.executeQuery();
                ResultSet temp=resultSet;
                if(!temp.next())
                    JOptionPane.showMessageDialog(rootPane, "No Such ID Found");
                else{
                    DefaultTableModel dmod=(DefaultTableModel)users.getModel();
                    while(dmod.getRowCount()>0)
                    {
                        for(int j=0;j<dmod.getRowCount();j++)
                            dmod.removeRow(j);
                    }
                    dmod.setRowCount(20);
                    preparedStatement = connect.prepareStatement("select*from users where ID='"+id1+"'");
                    resultSet = preparedStatement.executeQuery();
                }
                int row=0;
                while(resultSet.next())
                {
                    users.setValueAt(resultSet.getString("ID"),row,0);
                    users.setValueAt(resultSet.getString("NAME"),row,1);
                    users.setValueAt(resultSet.getString("AMOUNT"),row,2);
                    row++;
                }       
            }
            else{
                JOptionPane.showMessageDialog(rootPane, "Please Select An User");
            }
        }
        catch(Exception e){
            System.out.println(e.getMessage());
        }   
    }//GEN-LAST:event_idButtonActionPerformed

    private void showAllActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_showAllActionPerformed
        loadUsers();        // TODO add your handling code here:
    }//GEN-LAST:event_showAllActionPerformed

    private void nameButtonActionPerformed(java.awt.event.ActionEvent evt) {//GEN-FIRST:event_nameButtonActionPerformed
        try{
            if(name.getText().trim().equals("")==false)
            {
                String id1=name.getText();
                Class.forName("com.mysql.jdbc.Driver");
                connect = DriverManager.getConnection("jdbc:mysql://127.0.0.1/bankmanagement?user=root");
                preparedStatement = connect.prepareStatement("select*from users where NAME='"+id1+"'");
                resultSet = preparedStatement.executeQuery();
                ResultSet temp=resultSet;
                if(!temp.next())
                    JOptionPane.showMessageDialog(rootPane, "No Such NAME Found");
                else{
                    DefaultTableModel dmod=(DefaultTableModel)users.getModel();
                    while(dmod.getRowCount()>0)
                    {
                        for(int j=0;j<dmod.getRowCount();j++)
                            dmod.removeRow(j);
                    }
                    dmod.setRowCount(20);
                    preparedStatement = connect.prepareStatement("select*from users where NAME='"+id1+"'");
                    resultSet = preparedStatement.executeQuery();
                }
                int row=0;
                while(resultSet.next())
                {
                    users.setValueAt(resultSet.getString("ID"),row,0);
                    users.setValueAt(resultSet.getString("NAME"),row,1);
                    users.setValueAt(resultSet.getString("AMOUNT"),row,2);
                    row++;
                }       
            }
            else{
                JOptionPane.showMessageDialog(rootPane, "Please Select An User");
            }
        }
        catch(Exception e){
            System.out.println(e.getMessage());
        }   
    }//GEN-LAST:event_nameButtonActionPerformed
    public static void loadCurrentUsers(){
        try{
            dmod=(DefaultTableModel)current.getModel();
            while(dmod.getRowCount()>0)
            {
                for(int j=0;j<dmod.getRowCount();j++)
                    dmod.removeRow(j);
            }
            dmod.setRowCount(22);
            for(i=0;i<currentUsers.size();i++)
            {
                String sentence[]=currentUsers.get(i).toString().split(":");
                current.setValueAt(sentence[0], i, 0);
                current.setValueAt(sentence[1], i, 1);
            }
        }
        catch(Exception e)
        {
            System.out.println(e.getMessage());
        }
    }
    public static void main(String args[])throws Exception {
        
        java.awt.EventQueue.invokeLater(new Runnable() {
            public void run() {
                new Server().setVisible(true);
            }
        });
        ServerSocket welcomeSocket = new ServerSocket(6782);
        System.out.println(welcomeSocket.isClosed());
        ObjectOutputStream oos[]=new ObjectOutputStream[4];
        int i=0;
        SThread1 s;
        for(i=0;;i++) {
            Socket connectionSocket = welcomeSocket.accept();
            BufferedReader inFromClient =
                    new BufferedReader(new InputStreamReader(
                    connectionSocket.getInputStream()));
            DataOutputStream outToClient =
                    new DataOutputStream(
                    connectionSocket.getOutputStream());
            System.out.println("Client : "+i+" Connected");
            s=new SThread1(inFromClient, outToClient, i);
            s.start();     
        }
    }
    public void loadUsers(){
        try{
            Class.forName("com.mysql.jdbc.Driver");
            connect = DriverManager.getConnection("jdbc:mysql://127.0.0.1/bankmanagement?user=root");
            preparedStatement = connect.prepareStatement("select*from users");
            resultSet = preparedStatement.executeQuery();
            int row=0;
            while(resultSet.next())
            {
                users.setValueAt(resultSet.getString("ID"),row,0);
                users.setValueAt(resultSet.getString("NAME"),row,1);
                users.setValueAt(resultSet.getString("AMOUNT"),row,2);
                row++;
            }
        }
        catch(Exception e){
            System.out.println(e.getMessage());
        }
    }
    // Variables declaration - do not modify//GEN-BEGIN:variables
    public static javax.swing.JTable current;
    private javax.swing.JTable history;
    private javax.swing.JButton historyButton;
    private javax.swing.JTextField id;
    private javax.swing.JButton idButton;
    private javax.swing.JLabel jLabel1;
    private javax.swing.JLabel jLabel2;
    private javax.swing.JLabel jLabel3;
    private javax.swing.JPanel jPanel1;
    private javax.swing.JScrollPane jScrollPane1;
    private javax.swing.JScrollPane jScrollPane2;
    private javax.swing.JScrollPane jScrollPane3;
    private javax.swing.JTextField name;
    private javax.swing.JButton nameButton;
    private javax.swing.JButton showAll;
    private javax.swing.JTable users;
    // End of variables declaration//GEN-END:variables
}
class SThread1 extends Thread{
    private static Connection connect = null;
    private static Statement statement = null;
    private static PreparedStatement preparedStatement = null;
    private static ResultSet resultSet = null;
    BufferedReader inFromClient;
    DataOutputStream outToClient;
    String clientSentence;
    String id="";
    String name="";
    int srcid;
    public SThread1(BufferedReader in, DataOutputStream out,int a) {
        inFromClient = in;
        outToClient = out;
        srcid = a;
    }

    @Override
    public void run() {
        while (true) {
            try {
                    clientSentence = inFromClient.readLine();
                    System.out.println("From Client : "+(srcid+1)+" : "+clientSentence);
                    if(clientSentence.contains("Identity")&&checkIdentity(clientSentence))
                    {
                        Server.currentUsers.add(id+":"+name);
                        Server.loadCurrentUsers();
                        String send="Authorized:"+id+":"+name;
                        outToClient.writeBytes(send+'\n');
                    } 
                    else if(clientSentence.contains("Identity")&&!checkIdentity(clientSentence))
                    {
                        outToClient.writeBytes("Error : ID or PASSWORD incorrect"+'\n');
                    }
            } 
            catch (Exception e) {
                System.out.println(e.getMessage());
            }
        }
    }
    public boolean checkIdentity(String client){
        boolean value=false;
        try{
            String cinfo[]=client.split(":");
            Class.forName("com.mysql.jdbc.Driver");
            connect = DriverManager.getConnection("jdbc:mysql://127.0.0.1/bankmanagement?user=root");
            preparedStatement = connect.prepareStatement("select*from users where ID='"+cinfo[1]+"'"+"and PASS='"+cinfo[2]+"'");
            resultSet = preparedStatement.executeQuery();
            int row=0;
            while(resultSet.next())
            {
                id=resultSet.getString("ID");
                name=resultSet.getString("NAME");
                row++;
            }
            if(row!=0)
                value=true;
        }
        catch(Exception e)
        {
            System.out.println(e.getMessage());
        }
        return value;
    }
}

