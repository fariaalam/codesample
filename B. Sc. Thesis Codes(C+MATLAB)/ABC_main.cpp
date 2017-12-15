#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <conio.h>
#include <time.h>


#define runtime 10  
#define NP 100 
#define FoodNumber NP 
#define pi 3.1416 
#define func 7

   

int emFoodNumber=(int)(FoodNumber*0.5),onFoodNumber=(int)(FoodNumber*0.5);
char *filename="ABC_Data_Limit=1500.txt";

double f_min;
double ferr[7];
int maxCycle,D; 
int limit;
double lb, ub; 
int n,function_no;
double temp1,temp2,temp3,temp4,temp5,for14[2][25],ai[11],bi[11],aij[10][6],pij[10][6],c[10];
double Foods[FoodNumber][50];
double f[FoodNumber];  
double fitness[FoodNumber]; 
double trial[FoodNumber]; 
double prob[FoodNumber]; 
double solution [50]; 
double ObjValSol; 
double FitnessSol; 
int neighbour, param2change; 
double GlobalMin; 
double GlobalParams[50]; 
double GlobalMins[runtime]; 
double r; 


void valueInitialization();
double calculateObjFunc(double sol[] , int function);
double calculateU(double x,double a,double k,double m); 

double CalculateFitness(double fun)
 {
	 double result=0;
	 if(fun>=0)
	 {
		 result=1/(fun+1);
	 }
	 else
	 {
		 result=1+fabs(fun);
	 }
	 return result;
 }


void MemorizeBestSource()
{
   int i,j;
    
	for(i=0;i<emFoodNumber;i++)
	{
		if (f[i]<GlobalMin)
		{
        	GlobalMin=f[i];
        	for(j=0;j<D;j++)
           		GlobalParams[j]=Foods[i][j];
        }
	}
 }


void init(int index)
{
   int j;
   for (j=0;j<D;j++)
	{
        r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        Foods[index][j]=r*(ub-lb)+lb;
		solution[j]=Foods[index][j];
	}
	f[index]=calculateObjFunc(solution,function_no);
	fitness[index]=CalculateFitness(f[index]);
	trial[index]=0;
}


void initial()
{
	int i;
	valueInitialization();
	for(i=0;i<emFoodNumber;i++)
	{
		init(i);
	}
	GlobalMin=f[0];
    for(i=0;i<D;i++)
    GlobalParams[i]=Foods[0][i];
}

void valueInitialization(){
	
	switch(function_no){
		
		case 0:	D=30;
		        maxCycle=1500;
		        lb=-100;
		        ub=100;
		        f_min=0.00;
		        break;
		case 1:	D=30; //4
				maxCycle=20000;
				lb=-30;
				ub=30;
				f_min=0.00;
				break;
		case 2:	D=30; //7
				maxCycle=1500;
				lb=-100;
				ub=100;
				f_min=0.00;
				break;
		case 3:	D=30; //7
				maxCycle=9000;
				lb=-500;
				ub=500;
				f_min=-12569.5;
				break;
		case 4:	D=30;//8
				maxCycle=5000;
				lb=-5.12;
				ub=5.12;
				f_min=0;
				break;
		case 5: D=30;//9
				maxCycle=1500;
				lb=-32;
				ub=32;
				f_min=0.00;		
				break;
		case 6:D=30;  //10
				maxCycle=2000;
				lb=-600;
				ub=600;
				f_min=0.00;
				break;																							
		default:printf("not initialized");
		        break;			        
				
		 
	}
}


void SendEmployedBees()
{
  	int i,j;
  
   	for (i=0;i<emFoodNumber;i++)
	{
        
    	r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        param2change=(int)(r*D);
        
        
        r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        neighbour=(int)(r*emFoodNumber);

                
        while(neighbour==i)
        {
        	r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        	neighbour=(int)(r*emFoodNumber);
        }
        for(j=0;j<D;j++)
        solution[j]=Foods[i][j];

        /*v_{ij}=x_{ij}+\phi_{ij}*(x_{kj}-x_{ij}) */
        r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        solution[param2change]=Foods[i][param2change]+(Foods[i][param2change]-Foods[neighbour][param2change])*(r-0.5)*2;

        
        if (solution[param2change]<lb)
           solution[param2change]=lb;
        if (solution[param2change]>ub)
           solution[param2change]=ub;
        ObjValSol=calculateObjFunc(solution,function_no);
        FitnessSol=CalculateFitness(ObjValSol);
        
        
        if (FitnessSol>fitness[i])
        {
        	trial[i]=0;
        	for(j=0;j<D;j++)
        		Foods[i][j]=solution[j];
        	f[i]=ObjValSol;
        	fitness[i]=FitnessSol;
        }
        else
        {   
            trial[i]=trial[i]+1;
        }
	}
}



void CalculateProbabilities()
{
    int i,x,sum=0;
    double maxfit;
    maxfit=fitness[0];
  	for (i=1;i<emFoodNumber;i++)
    {
        if (fitness[i]>maxfit)
           maxfit=fitness[i];
    }
	for (x=0;x<emFoodNumber;x++){
 		sum=sum+fitness[x];
 	}
 	for (i=0;i<emFoodNumber;i++)
    {
        prob[i]=(0.9*(fitness[i]/sum))+0.1;
        //prob[i]=(0.9*(fitness[i]/maxfit))+0.1;
    }

}

void SendOnlookerBees()
{

  	int i,j,t;
  	i=0;
  	t=0;
  
  	while(t<onFoodNumber)
    {

    	r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        if(r<prob[i])
        {        
        	t++;
        
        
        	r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        	param2change=(int)(r*D);
        
        
        	r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        	neighbour=(int)(r*onFoodNumber);

                
        	while(neighbour==i)
        	{
        		r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        		neighbour=(int)(r*onFoodNumber);
        	}
        	for(j=0;j<D;j++)
        	solution[j]=Foods[i][j];

        
        	r = (   (double)rand() / ((double)(RAND_MAX)+(double)(1)) );
        	solution[param2change]=Foods[i][param2change]+(Foods[i][param2change]-Foods[neighbour][param2change])*(r-0.5)*2;

        
        	if (solution[param2change]<lb)
           		solution[param2change]=lb;
        	if (solution[param2change]>ub)
           		solution[param2change]=ub;
        	ObjValSol=calculateObjFunc(solution,function_no);
        	FitnessSol=CalculateFitness(ObjValSol);
        
        
        	if (FitnessSol>fitness[i])
        	{
        		trial[i]=0;
        		for(j=0;j<D;j++)
        			Foods[i][j]=solution[j];
        		f[i]=ObjValSol;
        		fitness[i]=FitnessSol;
        	}
        	else
        	{   
            	trial[i]=trial[i]+1;
        	}
        } /*if */
        i++;
        if (i==emFoodNumber)
        	i=0;
    }/*while*/

        
}


void SendScoutBees()
{
	int maxtrialindex,i;
	maxtrialindex=0;
	limit=onFoodNumber*D;
	for (i=1;i<emFoodNumber;i++)
    {
        if (trial[i]>trial[maxtrialindex])
        maxtrialindex=i;
    }
	if(trial[maxtrialindex]>=limit)
	{
		init(maxtrialindex);
	}
}


/*Main program of the ABC algorithm*/
int main()
{
	int iter,run,j;
	double mean,avg,devSum,stddev;
	mean=0;
	srand(time(NULL));
	int fn,z;
	FILE *f;
	f=fopen(filename,"w");
	if(f==NULL)
	{
		printf("File not found.\n");
	}
	fprintf(f,"employee_bees=%d   onlooker_Bees=%d\n",emFoodNumber,onFoodNumber);
	fclose(f);
	f=fopen("ABC/Function1.txt","w");
	fclose(f);
	f=fopen("ABC/Function2.txt","w");
	fclose(f);
	f=fopen("ABC/Function3.txt","w");
	fclose(f);
	f=fopen("ABC/Function4.txt","w");
	fclose(f);
	f=fopen("ABC/Function5.txt","w");
	fclose(f);
	f=fopen("ABC/Function6.txt","w");
	fclose(f);
	f=fopen("ABC/Function7.txt","w");
	fclose(f);
	for(fn=0;fn<func;fn++){
	        
	        function_no=fn;
	        printf("Function %d:START",fn+1);
			for(run=0;run<runtime;run++)
			{
			
				initial();
				MemorizeBestSource();
				for (iter=0;iter<maxCycle;iter++)
				{
					SendEmployedBees();
					CalculateProbabilities();
					SendOnlookerBees();
					MemorizeBestSource();
					SendScoutBees();
					if(run==9)
					{
						if(fn==0)
						{
							f=fopen("ABC/Function1.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
						else if(fn==1)
						{
							f=fopen("ABC/Function2.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
						else if(fn==2)
						{
							f=fopen("ABC/Function3.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
						else if(fn==3)
						{
							f=fopen("ABC/Function4.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
						else if(fn==4)
						{
							f=fopen("ABC/Function5.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
						else if(fn==5)
						{
							f=fopen("ABC/Function6.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
						else if(fn==6)
						{
							f=fopen("ABC/Function7.txt","a+");
							fprintf(f,"%e\n",GlobalMin);
							fclose(f);
						}
					}
				}
				for(j=0;j<D;j++)
				{
				    //printf("GlobalParam[%d]: %.3f\n",j+1,GlobalParams[j]);
				}
				
				printf("%d. run: %.3e \n",run+1,GlobalMin);
				GlobalMins[run]=GlobalMin;
				mean=mean+GlobalMin;
			}
			avg=mean/runtime;
		
			ferr[fn]=(double)fabs((f_min-avg));
			for(z=0;z<runtime;z++)
			{
				devSum=devSum+(GlobalMins[z]-avg)*(GlobalMins[z]-avg);
			}
			
			stddev=devSum/runtime;
			stddev=sqrt(stddev);
			printf("Function %d:EXECUTED\n",fn+1);
			
			f=fopen(filename,"a+");
			fprintf(f,"FUNCTION %d RESULT: \nMean Average : %.3e\t STANDARD DEVIATION: %.3e\n Absolute Error:%.3e\n\n ",fn+1,avg,stddev,ferr[fn]);
			fclose(f);
			
			printf("FUNCTION %d RESULT: Mean Average: %.3e\t  STANDARD DEVIATION: %.3e\n Mean Absolute Error:%.3e\n\n ",fn+1,avg,stddev,ferr[fn]);
		   
			mean=0;
			devSum=0;
	}
	double meanerr=0;
	for(int i=0;i<func;i++)
		meanerr=meanerr+ferr[i];
	meanerr=meanerr/6;	
	f=fopen(filename,"a+");
	fprintf(f,"\n\nMean Absolute Error : %.3e",meanerr);
	fclose(f);
	return 0;
}
 
double calculateObjFunc(double sol[] , int function)
{
	double sum,sum1=0,sum2=0;
	int k,z;
	if(function==0)
	{
		n=30;
		for(k=0;k<n;++k)
            sum1= sum1+ sol[k]*sol[k];
        sum=sum1;
	}
	if(function==1)//4
	{
		n=30;
		sum1=0.00;
		for(k=0;k<n-1;++k)
        {
        	temp1=sol[k];
        	temp2=pow(temp1,2);
        	temp3=sol[k+1];
        	temp4=temp3-temp2;
        	temp5=(100*pow(temp4,2));
        	temp1=sol[k]-1;
        	temp2=pow(temp1,2);
        	temp3=temp2+temp5;
        	sum1=sum1+temp3;
		} 
		sum=sum1;
	}
	if(function==2)
	{
		n=30;
		sum1=0;
		for(k=0;k<n;k++)
			sum1+=(floor(sol[k]+0.5))*(floor(sol[k]+0.5));
		sum=sum1;
	}
	if(function==3)//7
	{  
	    n=30;
		sum1=0.00;sum2=0.00;
		for(k=0;k<n;k++)
		{	
			temp1=sqrt(fabs(sol[k]));
			temp2=sin(temp1);
			sum1=sum1+((-sol[k])*temp2);
		}
		sum=sum1;
	}
	if(function==4)//8
	{ 
		
	    n=30;
		sum1=0.00;sum2=0.00;
		for(k=0;k<n;k++)
		{
			 n=30;
			sum1=0.00;sum2=0.00;
			for(k=0;k<n;k++)
			{
				temp1=cos(2*pi*sol[k]);
				temp2=pow(sol[k],2);
				sum1=sum1+(temp2-(10*temp1)+10);			
			}
			sum=sum1;		
		}
		sum=sum1;
	}
	if(function==5)//9
	{
		n=30;
		sum1=0.00;sum2=0.00;
		for(k=0;k<n;++k)
            sum1= sum1+ sol[k]*sol[k];
            
        for(k=0;k<n;++k)
        	sum2=sum2+cos(2*pi*sol[k]/180);
        	
        temp1=(-0.2)*sqrt((sum1)/n);
        temp2=exp(temp1);
        temp3=exp(sum2/n);
        sum=(-20)*temp2-temp3+20+exp(1.0);
		
	}
	if(function==6)//10
	{
		n=30;
		sum1=0.00;sum2=1.00;
		for(k=0;k<n;++k)
        {
          	sum1= sum1+ sol[k]*sol[k];
		}  
        for(k=0;k<n;++k)
        {
        	temp1=cos(sol[k]/sqrt(k+1));
        	sum2= sum2*temp1;
		} 
        temp1=(sum1/4000);
        sum=temp1-sum2+1;
	}
	return sum;
}


double calculateU(double x,double a,double k,double m)
{
	double temp;
	if(x>a)
	{
		temp=k*pow((x-a),m);
		return temp;
	}
	else if(-a<=x&&x<=a)
	{
		return 0;
	}
	else if(x<-a)
	{
		temp=k*pow((-x-a),m);
		return temp;
	}
}
