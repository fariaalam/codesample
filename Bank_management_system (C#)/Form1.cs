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
    public partial class login_pg : Form
    {
        public login_pg()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            string user, ssn, dept,id;

            string ora = "Data Source=(DESCRIPTION=(CID=GTU_APP)(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(HOST=fariapc)(PORT=1521)))(CONNECT_DATA=(SID=XE)(SERVER=DEDICATED)));User Id=banksolution;Password=bs;";
            OracleConnection oradb = new OracleConnection(ora);
           
            user = username.Text.ToString();
            ssn = social_security_num.Text.ToString();
            dept = department.Text.ToString();
            if (dept == "Human_Resource")
                dept = "100hr";
            else if (dept == "Administration")
                dept = "100ad";
            else if (dept == "Financial")
                dept = "100fn";
            else if (dept == "Technology")
                dept = "100tec";

            oradb.Open();
            OracleCommand com = new OracleCommand();
            com.Connection = oradb;
            com.CommandText = "Select EMPLOYEE_ID,EMPLOYEE_NAME from EMPLOYEE where EMAIL='" + user + "' and SOCIAL_SECURITY_NUMBER='" + ssn + "' and DEPARTMENT_ID='" + dept + "'";
            OracleDataReader rd = com.ExecuteReader();
            if (rd.Read())
            {
                id = rd["EMPLOYEE_ID"].ToString();
                if(id.Contains("fn")){
                    this.Hide();
                    cust_info obj = new cust_info();
                    obj.ShowDialog();
                }
                //MessageBox.Show("Name:" + " " + rd["EMPLOYEE_NAME"].ToString() + "Id:" + " " + rd["EMPLOYEE_ID"].ToString());
            }
            else
                MessageBox.Show("Not succedd");
            oradb.Close();

                //com.CommandText = "Insert into EMPLOYEE(EMPLOYEE_ID,EMPLOYEE_NAME,SOCIAL_SECURITY_NUMBER,DEPARTMENT_ID,DESIGNATION,PHONE_NUMBER,EMAIL,SALARY,APPOINTMENT_DATE,DOB,PROJECT_ID,ADDRESS) values('100ad109','Pakhi',45678,'100ad','manager','0897532','pakh@gmail.com',30000,'20-JAN-12','20-FEB-85',102,'NILKHET')";

            //int a = com.ExecuteNonQuery();
            //if (a == 0)
            //    MessageBox.Show("Not inserted");
            //else
            //    MessageBox.Show("Success");
            //oradb.Close();
           
        }

        private void login_pg_Load(object sender, EventArgs e)
        {

        }
    }
}
