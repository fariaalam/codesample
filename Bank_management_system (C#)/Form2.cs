using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Data.OracleClient;

namespace WindowsFormsApplication1
{
    public partial class cust_info : Form
    {
        string ora = "Data Source=(DESCRIPTION=(CID=GTU_APP)(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=fariapc)(PORT=1521)))(CONNECT_DATA=(SID=XE)(SERVER=DEDICATED)));User Id=banksolution;Password=bs;";
        string id;
        int db_amount,box_amount;
        public cust_info()
        {
            InitializeComponent();
        }

        private void cust_info_Load(object sender, EventArgs e)
        {

        }

        private void textBox5_TextChanged(object sender, EventArgs e)
        {

        }

        private void textBox4_TextChanged(object sender, EventArgs e)
        {

        }

        private void show_Click(object sender, EventArgs e)
        {

            
            id = acc_id.Text.ToString();
            OracleConnection oradb = new OracleConnection(ora);
            oradb.Open();
            OracleCommand com = new OracleCommand();
            com.Connection = oradb;
            com.CommandText = "Select CUSTOMER_NAME,OPENING_DATE,ACCOUNT_AMOUNT,FIXED_DEPOSIT,DURATION,PROFIT,NOMINEE_NAME, FDR_OPENING_DATE from CUSTOMER where ACCOUNT_ID='"+ id +"'";
            OracleDataReader rd = com.ExecuteReader();
            if (rd.Read())
            {
                cust_name.Text = rd["CUSTOMER_NAME"].ToString();
                op_date.Text = rd["OPENING_DATE"].ToString();
                acc_amount.Text = rd["ACCOUNT_AMOUNT"].ToString();
                fdr.Text = rd["FIXED_DEPOSIT"].ToString();
                duration.Text = rd["DURATION"].ToString();
                profit.Text = rd["PROFIT"].ToString();
                nominee.Text = rd["NOMINEE_NAME"].ToString();
                op_fdr.Text = rd["FDR_OPENING_DATE"].ToString();

            }
            else
                MessageBox.Show("Invalid Account");
            oradb.Close();
        }

        private void withdraw_Click(object sender, EventArgs e)
        {
            try
            {
                OracleConnection oradb = new OracleConnection(ora);
               
                db_amount = Convert.ToInt32(acc_amount.Text);
                box_amount = Convert.ToInt32(amount.Text);
                db_amount = db_amount - box_amount;
                oradb.Open();
                OracleCommand com1 = new OracleCommand();
                com1.Connection = oradb;
                com1.CommandText = "Update  CUSTOMER SET ACCOUNT_AMOUNT='" + db_amount + "' WHERE ACCOUNT_ID= '" + id + "'";
                OracleDataReader rd3 = com1.ExecuteReader();
                oradb.Close();
                acc_amount.Text = db_amount.ToString();
                amount.Text = "";
            }
            catch (OracleException ex)
            {
                MessageBox.Show(ex.Message);
                amount.Text = "";
            }
        }

        private void fdr_withdraw_Click(object sender, EventArgs e)
        {
            try
            {
                OracleConnection oradb = new OracleConnection(ora);
                int fdr_amnt;
                fdr_amnt = Convert.ToInt32(fdr.Text);
                db_amount = Convert.ToInt32(acc_amount.Text);
                db_amount = db_amount + fdr_amnt;
                oradb.Open();
                OracleCommand com3 = new OracleCommand();
                com3.Connection = oradb;
                com3.CommandText = "Update  CUSTOMER SET ACCOUNT_AMOUNT='"+db_amount+ "' WHERE ACCOUNT_ID= '"+ id +"'";
                OracleDataReader rd2 = com3.ExecuteReader();
                oradb.Close();
                fdr.Text = "";
                duration.Text = "";
                profit.Text = "";
                nominee.Text = "";
                op_fdr.Text = "";
                acc_amount.Text = db_amount.ToString();
                //oradb.Open();
                //OracleCommand com2 = new OracleCommand();
                //com2.Connection = oradb;
                //com2.CommandText = "Update  CUSTOMER SET FIXED_DEPOSIT='" + fdr.Text.ToString() + "'" +
                //                                        ",NOMINEE_NAME='" + nominee.Text.ToString() + "'" +
                //                                        ",FDR_OPENING_DATE='" + op_fdr.Text.ToString() + "'" +
                //                                        ",DURATION='" + duration.Text.ToString() + "'" +
                //                                        ",PROFIT='" + profit.Text .ToString()+ "'" +
                //                                        "'WHERE ACCOUNT_ID= '" + id + "'";
                //OracleDataReader rd1 = com2.ExecuteReader();
                //oradb.Close();
            }catch(OracleException ex){
                
                MessageBox.Show(ex.Message);
                

            }

            
        }

        private void add_Click(object sender, EventArgs e)
        {

            OracleConnection oradb = new OracleConnection(ora);
            db_amount = Convert.ToInt32(acc_amount.Text);
            box_amount = Convert.ToInt32(amount.Text);
            db_amount = db_amount + box_amount;
            oradb.Open();
            OracleCommand com4 = new OracleCommand();
            com4.Connection = oradb;
            com4.CommandText = "Update  CUSTOMER SET ACCOUNT_AMOUNT='" + db_amount + "' WHERE ACCOUNT_ID= '" + id + "'";
            OracleDataReader rd4 = com4.ExecuteReader();
            oradb.Close();
            acc_amount.Text = db_amount.ToString();
            amount.Text = "";

        }
    }
}
