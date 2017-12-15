
# include "de.h"
#include <time.h>
#include<conio.h>


#define runtime 10 
#define np 100 
#define FoodNumber np
#define pi 3.1416 
#define func 7 

int fn,run;
int a,b,callDE,callABC;


/*..........For Adaptive............*/
int startABC, endABC, startDE, endDE, startIFEP, endIFEP, atMost = 12, atLeast = 1;
long double minStartABC, minEndABC, minStartDE, minEndDE, minStartIFEP, minEndIFEP;
long double changeABC, changeDE, changeIFEP;
/*..............End.................*/

/*.......................Function Definitions for IFEP.............*/
void mainIFEP();
int uniform(int a, int b);
long double uniformDeviate(int a);
double checkDomain(double value);
long double normalRV();
long double cauchyRV();
int found(int win[], int j, int b);
/*.............End of Function Definition............*/


/*..........................vriables for ABC...................... */
int emFoodNumber = (int)(FoodNumber*0.5), onFoodNumber = (int)(FoodNumber*0.5);
//char *filename = "C:Users\Saadi\Desktop\Outputs\Hybrid(DE,ABC) Adaptive.txt";

double f_min;
double ferr[8];
int maxCycle;
int limit;
double lb, ub;
int n, function_no;
double temp1, temp2, temp3, temp4, temp5;
double Foods[FoodNumber][50];
double f[FoodNumber];
double fitness[FoodNumber];
double trial[FoodNumber];
double prob[FoodNumber];
double solution[50];
double ObjValSol;
double FitnessSol;
int neighbour, param2change;
double GlobalMin;
double GlobalParams[50];
double GlobalMins[runtime];
double r;

/*--------- End Variable definitions-----------------------------------------*/




/*..............................vriables for DE..................................*/
long  rnd_uni_init;
int FUNC_VARS = 30;
double c[MAXPOP][MAXDIM], d[MAXPOP][MAXDIM];
double(*pold)[MAXPOP][MAXDIM], (*pnew)[MAXPOP][MAXDIM], (*pswap)[MAXPOP][MAXDIM], (*pe)[MAXPOP][MAXDIM];
char  chr = 'a';             /* y/n choice variable                */

int   i, j, L;      /* counting variables                 */
int   r1, r2, r3, r4;  /* placeholders for random indexes    */
int   r5;              /* placeholders for random indexes    */
int   D = 30;               /* Dimension of parameter vector      */
int   NP = 100;              /* number of population members       */
int   imin;            /* index to member with lowest energy */
int   refresh = 1;         /* refresh rate of screen output      */
int   strategy = 2;        /* choice parameter for screen output */
int   gen, genmax = 1500, seed = 3;

long  nfeval = 0;          /* number of function evaluations     */

double trial_cost;      /* buffer variable                    */
double inibound_h = 100;      /* upper parameter bound              */
double inibound_l = -100;      /* lower parameter bound              */
double tmp[MAXDIM], best[MAXDIM], bestit[MAXDIM]; /* members  */
double cost[MAXPOP];    /* obj. funct. values                 */
double cvar;            /* computes the cost variance         */
double cmean;           /* mean cost                          */
double F = 0.6, CR = 0.9;            /* control variables of DE            */
double Fsum, CRsum, piisum, Favg, CRavg;
double cmin, e[MAXPOP][MAXDIM];            /* help variables                     */


FILE  *fpout_ptr;
int FNo = 1;
const double Finit = 0.6;  // F   INITIAL FACTOR VALUE
const double CRinit = 0.9;  // CR  INITIAL FACTOR VALUE

const double Fl = 0.1; // F in the range [0.1, 1.0]
const double Fu = 0.9; //

const double CRl = 0.0; // CR in the range [0.0, 1.0]
const double CRu = 1.0; //

const double tao1 = 0.1; // probability to adjust F 
const double tao2 = 0.1; // probability to adjust CR

double dom1[] = { 0, -100, -10, -100, -100, -30, -100, -1.28, -500, -5.12, -32, -600, -50, -50 };

/*--------- End Variable definitions-----------------------------------------*/




/* Functions for DE */
void  assignd(int D, double a[], double b[]);
double rnd_uni(long *idum);    /* uniform pseudo random number generator */
double evaluate(int D, double tmp[], long *nfeval, int fnum); /* obj. funct. */
void mainDE();
/*--------- End Function definitions-----------------------------------------*/


/*.......................Functions For ABC...................................*/
void mainABC();
void valueInitialization();
double calculateObjFunc(double sol[], int function);
double calculateU(double x, double a, double k, double m);
void MemorizeBestSource();
void init(int index);
void initial();
void SendEmployedBees();
void CalculateProbabilities();
void SendOnlookerBees();
void SendOnlookerBees();
void SendScoutBees();
/*.....................End of Function Definition of ABC......................*/
int max(int a, int b)
{
	if (a >= b)
		return a;
	else if (b >= a)
		return b;
}
int min(int a, int b)
{
	if (a <= b)
		return a;
	else if (b <= a)
		return b;
}


int main(int argc, char *argv[])
{

	time_t t;
	time(&t);
	srand(time_t(t));
	FILE *f;
	f = fopen("Hybrid_Data(DE,ABC) Adaptive.txt", "w");
	fclose(f);
	f=fopen("Hybrid2/Function1.txt","w");
	fclose(f);
	f=fopen("Hybrid2/Function2.txt","w");
	fclose(f);
	f=fopen("Hybrid2/Function3.txt","w");
	fclose(f);
	f=fopen("Hybrid2/Function4.txt","w");
	fclose(f);
	f=fopen("Hybrid2/Function5.txt","w");
	fclose(f);
	f=fopen("Hybrid2/Function6.txt","w");
	fclose(f);
	f=fopen("Hybrid2/Function7.txt","w");
	fclose(f);
	double abcdef = 0, mean = 0, stdDev, devSum = 0, meanerr, temp = 0;
	for (fn = 1; fn <= func; fn++)
	{
		FNo = fn;
		for (run = 0; run < runtime; run++)
		{
		abc:
			seed = rand() % 20;
			if (seed == 0)
				goto abc;
			rnd_uni_init = -(long)seed;
			initial();
			assignd(D + 3, best, c[imin]);
			assignd(D + 3, bestit, c[imin]);
			pold = &c;
			pnew = &d;
			pe = &e;
			MemorizeBestSource();
			callDE=0;a=15;
			callABC=0;b=15;
			for(i=0;i<15;i++)
			{
				callDE++;
				mainDE();
			}
			for(i=0;i<15;i++)
			{
				callABC++;
				mainABC();
			}
			MemorizeBestSource();
			int it;
			for (int i = 30; i < maxCycle; i = i + 15)
			{
				it = i;
				changeDE = fabs(minStartDE - minEndDE);
				changeABC = fabs(minStartABC - minEndABC);
				long double whole = changeDE + changeABC;
				changeDE = changeDE / whole;
				changeABC = changeABC / whole;
				a = (int)round(changeDE * 15);
				b = (int)round(changeABC * 15);
				if (a > 12)
					a = 12;
				if (b > 12)
					b = 12;
				if (a < 3)
					a = 3;
				if (b < 3)
					b = 3;
				if ((a + b) > 15)
				{
					if (max(a, b) == a)
						a = a - 1;
					else if (max(a, b) == b)
						b = b - 1;
				}
				if ((a + b) < 15)
				{
					if (min(a, b) == a)
						a = a + 1;
					else if (min(a, b) == b)
						b = b + 1;
				}
				if ((a < 0 || b < 0 || a>32767 || b>32767))
				{
					a = (rand() % 12) + 1;
					b = 15 - a;
				}
				callDE=0,callABC=0;
				int r1=rand()%15+1;
				if( (r1==a) || (a<b && r1<a ) || (a>b && r1>a) || (r1>b && r1<=a) )
				{
					for(int ijk=0;ijk<a;ijk++)
					{
						callDE++;
						mainDE();
					}
					for(int ijk=0;ijk<b;ijk++)
					{
						callABC++;
						mainABC();
					}	
				}	
				else if( (r1==b) || (b<a && r1<b ) || (b>a && r1>b) || (r1>a && r1<=b) )
				{
					for(int ijk=0;ijk<b;ijk++)
					{
						callABC++;
						mainABC();
					}
					for(int ijk=0;ijk<a;ijk++)
					{
						callDE++;
						mainDE();
					}
				}
			//	}	
			    
			}
			GlobalMins[run] = GlobalMin;
			mean = mean + GlobalMin;

		}
		mean = mean / runtime;
		for (int i = 0; i < runtime; i++)
		{
			devSum = devSum + (GlobalMins[i] - mean)*(GlobalMins[i] - mean);
		}
		stdDev = devSum / runtime;
		stdDev = sqrt(stdDev);
		ferr[fn] = fabs(mean - f_min);
		printf("Function %d : \n\t Mean Average : %.3e \n\t Standard Deviation : %.3e \n\t Absolute Error : %.3e \n\n\n", FNo, mean, stdDev, ferr[fn]);
		f = fopen("Hybrid_Data(DE,ABC) Adaptive.txt", "a+");
		fprintf(f, "Function %d : \n\t Mean Average : %.3e \n\t Standard Deviation : %.3e \n\t Absolute Error : %.3e \n\n\n", FNo, mean, stdDev, ferr[fn]);
		fclose(f);
		mean = 0;
		devSum = 0;
	}
	meanerr = 0;
	for (int i = 1; i <= 7; i++)
		meanerr = meanerr + ferr[i];
	meanerr = meanerr / 7;
	printf("Mean Absolute Error : %.3e", meanerr);
	f = fopen("Hybrid_Data(DE,ABC) Adaptive.txt", "a+");
	fprintf(f, "Mean Absolute Error : %.3e", meanerr);
	fclose(f);
	_getch();
	return(0);
}



void  assignd(int D, double a[], double b[])
{
	int j;
	for (j = 0; j<D; j++)
	{
		a[j] = b[j];
	}
}


double rnd_uni(long *idum)
{
	long j;
	long k;
	static long idum2 = 123456789;
	static long iy = 0;
	static long iv[NTAB];
	double temp;

	if (*idum <= 0)
	{
		if (-(*idum) < 1) *idum = 1;
		else *idum = -(*idum);
		idum2 = (*idum);
		for (j = NTAB + 7; j >= 0; j--)
		{
			k = (*idum) / IQ1;
			*idum = IA1*(*idum - k*IQ1) - k*IR1;
			if (*idum < 0) *idum += IM1;
			if (j < NTAB) iv[j] = *idum;
		}
		iy = iv[0];
	}
	k = (*idum) / IQ1;
	*idum = IA1*(*idum - k*IQ1) - k*IR1;
	if (*idum < 0) *idum += IM1;
	k = idum2 / IQ2;
	idum2 = IA2*(idum2 - k*IQ2) - k*IR2;
	if (idum2 < 0) idum2 += IM2;
	j = iy / NDIV;
	iy = iv[j] - idum2;
	iv[j] = *idum;
	if (iy < 1) iy += IMM1;
	if ((temp = AM*iy) > RNMX) return RNMX;
	else return temp;

}/*------End of rnd_uni()--------------------------*/


double mmax(double a, double b) {
	if (a > b) return a;
	else return b;
}

// [0, 1)
double mRandom() {
	return rand() / (RAND_MAX + 1.0);
}



double evaluate(int n, double X[], long *nfeval, int fnum)
{
	int j;
	double f = 0.0;
	double val = 0.0, val2 = 0.0, x1, m;
	double x, y, y1, sum = 0, mul = 1, part1 = 0, part2 = 0, part3 = 0, part4 = 0, part11 = 0, part22 = 0, part33 = 0, part44 = 0, max, aa, bb;
	double xi;

	(*nfeval)++;
	switch (fnum)
	{
	case 1://........................................Sphere
		for (j = 0; j<FUNC_VARS; j++)
			val += (X[j] * X[j]);
		break;
	case 2://........................................Rosenbrock
		sum = 0;
		for (j = 0; j<FUNC_VARS - 1; j++)
		{
			aa = X[j + 1];
			bb = X[j];
			sum += 100 * (aa - bb*bb)*(aa - bb*bb) + (bb - 1)*(bb - 1);
		}
		val = sum;
		break;
	case 3: 
		sum=0;
		for(j=0;j<FUNC_VARS;j++)
			sum+=(floor(X[j]+0.5))*(floor(X[j]+0.5));
		val=sum;
		break;
	case 4: //.................................schwefel 2.26
		sum = 0;
		for (j = 0; j<FUNC_VARS; j++)
		{
			if (X[j]<-500) X[j] = -500;
			if (X[j]>500) X[j] = 500;
			x = X[j];
			//sum += x * sin( sqrtff(fabs(x))  * 3.14159 / 180.0);
			sum += x * sin(sqrtf(fabs(x)));
		}
		val = -sum;
		break;
	case 5:  //................................//rastrigin
		for (j = 0; j<FUNC_VARS; j++)
		{
			m = cos(0.1096622709*X[j]);
			val += X[j] * X[j] + (-10.0*m + 10.0);
		}
		break;
	case 6:  //..................................Ackley                               
		sum = 0;
		for (j = 0; j<FUNC_VARS; j++)
		{
			sum += X[j] * X[j];
		}

		part11 = -1 * 0.2 * sqrtf(sum / (1.0*FUNC_VARS));
		part1 = -1 * 20 * exp(part11);

		sum = 0;

		for (j = 0; j<FUNC_VARS; j++)
		{
			sum += cos(X[j] * 2 * 3.14159 * 3.14159 / 180.0);
			//sum += X[j] * 2 * 3.14159;
		}

		sum = sum / (1.0*FUNC_VARS);
		part2 = exp(sum);

		val = part1 - part2 + 20 + exp(1.0);

		break;
	case 7: //........................................Griewank
		m = 1.0;
		val2 = 0.0;
		for (j = 0; j<FUNC_VARS; j++)
		{
			val2 += X[j] * X[j];
			m *= cos(0.0174532925* X[j] / sqrtf(j + 1));
		}
		val = val2 / 4000.0 + (-m + 1);
		break;
	}
	f = val;
	return f;
}


void mainDE()
{
	FILE *f;
		for (i = 0; i<NP; i++)         /* Start of loop through ensemble  */
		{

			do                        /* Pick a random population member */
			{                         /* Endless loop for NP < 2 !!!     */
				r1 = (int)(rnd_uni(&rnd_uni_init)*NP);
			} while (r1 == i);

			do                        /* Pick a random population member */
			{                         /* Endless loop for NP < 3 !!!     */
				r2 = (int)(rnd_uni(&rnd_uni_init)*NP);
			} while ((r2 == i) || (r2 == r1));

			do                        /* Pick a random population member */
			{                         /* Endless loop for NP < 4 !!!     */
				r3 = (int)(rnd_uni(&rnd_uni_init)*NP);
			} while ((r3 == i) || (r3 == r1) || (r3 == r2));

			do                        /* Pick a random population member */
			{                         /* Endless loop for NP < 5 !!!     */
				r4 = (int)(rnd_uni(&rnd_uni_init)*NP);
			} while ((r4 == i) || (r4 == r1) || (r4 == r2) || (r4 == r3));

			do                        /* Pick a random population member */
			{                         /* Endless loop for NP < 6 !!!     */
				r5 = (int)(rnd_uni(&rnd_uni_init)*NP);
			} while ((r5 == i) || (r5 == r1) || (r5 == r2) || (r5 == r3) || (r5 == r4));


			if (strategy == 1) /* strategy DE0 (not in our paper) */
			{
				assignd(D, tmp, (*pold)[i]);
				n = (int)(rnd_uni(&rnd_uni_init)*D);
				L = 0;
				do
				{
					tmp[n] = bestit[n] + F*((*pold)[r2][n] - (*pold)[r3][n]);

					n = (n + 1) % D;
					L++;
				} while ((rnd_uni(&rnd_uni_init) < CR) && (L < D));
			}


			else if (strategy == 2) /* strategy DE1 in the techreport */
			{
				assignd(D, tmp, (*pold)[i]);
				n = (int)(rnd_uni(&rnd_uni_init)*D);
				L = 0;
				do
				{
					tmp[n] = (*pold)[r1][n] + F*((*pold)[r2][n] - (*pold)[r3][n]);
					n = (n + 1) % D;
					L++;
				} while ((rnd_uni(&rnd_uni_init) < CR) && (L < D));
			}


			trial_cost = evaluate(D, tmp, &nfeval, FNo);  /* Evaluate new vector in tmp[] */

			if (trial_cost <= cost[i])   /* improved objective function value ? */
			{
				cost[i] = trial_cost;
				assignd(D + 3, (*pnew)[i], tmp);

				if (trial_cost<cmin)          /* Was this a new minimum? */
				{                               /* if so...*/
					cmin = trial_cost;           /* reset cmin to new low...*/
					imin = i;
					assignd(D + 3, best, tmp);
				}
			}
			else
			{
				assignd(D + 3, (*pnew)[i], (*pold)[i]); /* replace target with old value */
			}

		}
		assignd(D + 3, bestit, best);
		cmean = 0;
		for (j = 0; j<NP; j++)
		{
			cmean += cost[j];
		}
		cmean = cmean / NP;
		cvar = 0.;           /* now the variance              */
		for (j = 0; j<NP; j++)
		{
			cvar += (cost[j] - cmean)*(cost[j] - cmean);
		}
		cvar = cvar / (NP - 1);
		for (j = 0; j<NP; j++)
		{
			Fsum += (*pnew)[j][D];
			CRsum += (*pnew)[j][D + 1];
			//piisum += (*pnew)[j][D+2]; 
		}
		Favg = Fsum / NP;
		CRavg = CRsum / NP;

		pswap = pold;
		pold = pnew;
		pnew = pswap;
		MemorizeBestSource();
		if (callDE == 1)
		{
			minStartDE = GlobalMin;
		}
		if (callDE == a)
		{
			minEndDE = GlobalMin;
		}
		if(run==9)
		{
			if(fn==1)
			{
				f=fopen("Hybrid2/Function1.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
		    else if(fn==2)
			{
			    f=fopen("Hybrid2/Function2.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
		    }
			else if(fn==3)
		    {
				f=fopen("Hybrid2/Function3.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==4)
			{
				f=fopen("Hybrid2/Function4.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==5)
			{
				f=fopen("Hybrid2/Function5.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==6)
			{
				f=fopen("Hybrid2/Function6.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==7)
			{
				f=fopen("Hybrid2/Function7.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
		}
		
	
}


void mainABC()
{
	FILE *f;
		SendEmployedBees();
		CalculateProbabilities();
		SendOnlookerBees();
		MemorizeBestSource();
		SendScoutBees();
		if (callABC == 1)
		{
			minStartABC = GlobalMin;
		}
		if (callABC == b)
		{
			minEndABC = GlobalMin;
		}
		if(run==9)
		{
			if(fn==1)
			{
				f=fopen("Hybrid2/Function1.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
		    else if(fn==2)
			{
			    f=fopen("Hybrid2/Function2.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
		    }
			else if(fn==3)
		    {
				f=fopen("Hybrid2/Function3.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==4)
			{
				f=fopen("Hybrid2/Function4.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==5)
			{
				f=fopen("Hybrid2/Function5.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==6)
			{
				f=fopen("Hybrid2/Function6.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
			else if(fn==7)
			{
				f=fopen("Hybrid2/Function7.txt","a+");
				fprintf(f,"%e\n",GlobalMin);
				fclose(f);
			}
		}
	
}

double CalculateFitness(double fun)
{
	double result = 0;
	if (fun >= 0)
	{
		result = 1 / (fun + 1);
	}
	else
	{
		result = 1 + fabs(fun);
	}
	return result;
}


void MemorizeBestSource()
{
	int i, j;

	for (i = 0; i<NP; i++)
	{
		if (cost[i]<GlobalMin)
		{
			GlobalMin = cost[i];
			for (j = 0; j<D; j++)
				GlobalParams[j] = (*pold)[i][j];
		}
	}
}


void init(int index)
{
	for (j = 0; j<D; j++)
	{
		(*pold)[index][j] = lb + rnd_uni(&rnd_uni_init)*(ub - lb);
	}
	cost[i] = evaluate(D, (*pold)[index], &nfeval, FNo);
	fitness[i] = CalculateFitness(cost[index]);
	trial[index] = 0;
}


void initial()
{
	int i, j;
	rnd_uni_init = -(long)seed;
	nfeval = 0;
	valueInitialization();
	for (i = 0; i<NP; i++)
	{
		for (j = 0; j<D; j++)
		{
			c[i][j] = lb + rnd_uni(&rnd_uni_init)*(ub - lb);
			e[i][j] = 3;
		}
		cost[i] = evaluate(D, c[i], &nfeval, FNo);
		c[i][D] = Finit;
		c[i][D + 1] = CRinit;
		fitness[i] = CalculateFitness(cost[i]);
		trial[i] = 0;
	}
	GlobalMin = cost[0];
	for (i = 0; i<D; i++)
		GlobalParams[i] = c[0][i];
	cmin = cost[0];
	imin = 0;
	for (i = 1; i<NP; i++)
	{
		if (cost[i]<cmin)
		{
			cmin = cost[i];
			imin = i;
		}
	}

}

void valueInitialization(){

	switch (FNo){

	case 1:	D = 30;
		maxCycle = 1500;
		lb = -100;
		ub = 100;
		f_min = 0.00;
		break;
	case 2:	D = 30; //4
		maxCycle = 5000;
		lb = -30;
		ub = 30;
		f_min = 0.00;
		break;
	case 3:	D = 30; //7
		maxCycle = 1500;
		lb = -100;
		ub = 100;
		break;
	case 4:	D = 30;//8
		maxCycle = 1500;
		lb = -500;
		ub = 500;
		f_min = -12569.5;
		break;
	case 5: D = 30;//9
		maxCycle = 1500;
		lb = -5.12;
		ub = 5.12;
		f_min = 0.00;
		break;
	case 6:D = 30;  //10
		maxCycle = 1500;
		lb = -32;
		ub = 32;
		f_min = 0.00;
		break;
	case 7:D = 30;  //10
		maxCycle = 1500;
		lb = -600;
		ub = 600;
		f_min = 0.00;
		break;
	default: printf("not initialized");
		break;


	}
}


void SendEmployedBees()
{
	int i, j;

	for (i = 0; i<emFoodNumber; i++)
	{

		r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
		param2change = (int)(r*D);


		r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
		neighbour = (int)(r*emFoodNumber);


		while (neighbour == i)
		{
			r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
			neighbour = (int)(r*emFoodNumber);
		}
		for (j = 0; j<D; j++)
			solution[j] = (*pold)[i][j];

		/*v_{ij}=x_{ij}+\phi_{ij}*(x_{kj}-x_{ij}) */
		r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
		solution[param2change] = (*pold)[i][param2change] + ((*pold)[i][param2change] - (*pold)[neighbour][param2change])*(r - 0.5) * 2;


		if (solution[param2change]<lb)
			solution[param2change] = lb;
		if (solution[param2change]>ub)
			solution[param2change] = ub;
		ObjValSol = evaluate(D, solution, &nfeval, FNo);
		FitnessSol = CalculateFitness(ObjValSol);


		if (FitnessSol>fitness[i])
		{
			trial[i] = 0;
			for (j = 0; j<D; j++)
				(*pold)[i][j] = solution[j];
			cost[i] = ObjValSol;
			fitness[i] = FitnessSol;
		}
		else
		{
			trial[i] = trial[i] + 1;
		}
	}
}



void CalculateProbabilities()
{
	int i, x;
	double maxfit, sum = 0;
	maxfit = fitness[0];
	for (i = 1; i<emFoodNumber; i++)
	{
		if (fitness[i]>maxfit)
			maxfit = fitness[i];
	}
	for (x = 0; x<emFoodNumber; x++){
		sum = sum + fitness[x];
	}
	for (i = 0; i<emFoodNumber; i++)
	{
		prob[i] = (0.9*(fitness[i] / sum)) + 0.1;
		//prob[i]=(0.9*(fitness[i]/maxfit))+0.1;
	}

}

void SendOnlookerBees()
{

	int i, j, t;
	i = 0;
	t = 0;

	while (t<onFoodNumber)
	{

		r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
		if (r<prob[i])
		{
			t++;


			r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
			param2change = (int)(r*D);


			r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
			neighbour = (int)(r*onFoodNumber);


			while (neighbour == i)
			{
				r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
				neighbour = (int)(r*onFoodNumber);
			}
			for (j = 0; j<D; j++)
				solution[j] = (*pold)[i][j];


			r = ((double)rand() / ((double)(RAND_MAX)+(double)(1)));
			solution[param2change] = (*pold)[i][param2change] + ((*pold)[i][param2change] - (*pold)[neighbour][param2change])*(r - 0.5) * 2;


			if (solution[param2change]<lb)
				solution[param2change] = lb;
			if (solution[param2change]>ub)
				solution[param2change] = ub;
			ObjValSol = evaluate(D, solution, &nfeval, FNo);
			FitnessSol = CalculateFitness(ObjValSol);


			if (FitnessSol>fitness[i])
			{
				trial[i] = 0;
				for (j = 0; j<D; j++)
					(*pold)[i][j] = solution[j];
				cost[i] = ObjValSol;
				fitness[i] = FitnessSol;
			}
			else
			{
				trial[i] = trial[i] + 1;
			}
		} /*if */
		i++;
		if (i == emFoodNumber)
			i = 0;
	}/*while*/


}


void SendScoutBees()
{
	int maxtrialindex, i;
	maxtrialindex = 0;
	limit = onFoodNumber*D;
	for (i = 1; i<emFoodNumber; i++)
	{
		if (trial[i]>trial[maxtrialindex])
			maxtrialindex = i;
	}
	if (trial[maxtrialindex] >= limit)
	{
		init(maxtrialindex);
	}
}
void mainIFEP()
{
	int i, k, j, l, z, against, change, turn, winNumber[200];
	for (int turn = startIFEP; turn <= endIFEP; turn++)
	{
		double temp = n;
		double nor = normalRV();
		nor = normalRV();
		double t = 1.0 / sqrt(2 * sqrt(temp));
		double tp = 1.0 / sqrt(2 * temp);
		double tempCauchy, tempGaussian, stdDev, devSum = 0;
		int population = NP;
		for (j = population; j<2 * population; j++)
		{
			for (l = 0; l<n; l++)
			{
				(*pold)[j][l] = (*pold)[j - population][l] + ((*pe)[j - population][l] * cauchyRV());
				(*pe)[j][l] = (*pe)[j - population][l] * exp((tp *nor) + (t*normalRV()));
				(*pold)[j][l] = checkDomain((*pold)[j][l]);
			}
			tempCauchy = evaluate(D, (*pold)[j], &nfeval, FNo);

			for (l = 0; l<n; l++)
			{
				(*pold)[j][l] = (*pold)[j - population][l] + ((*pe)[j - population][l] * normalRV());
				(*pe)[j][l] = (*pe)[j - population][l] * exp((tp *nor) + (t*normalRV()));
				(*pold)[j][l] = checkDomain((*pold)[j][l]);
			}
			tempGaussian = evaluate(D, (*pold)[j], &nfeval, FNo);


			if (tempGaussian<tempCauchy)
				cost[j] = tempGaussian;
			else
				cost[j] = tempCauchy;

		}
		/*int win[80];
		for (z = 0; z<2 * population; z++)
		{
		winNumber[z] = 0;
		for (j = 0; j<80; j++)
		{

		against = uniform(0, ((2 * population) - 1));
		win[j] = against;
		while (against == z&&found(win, j,against) == 0)
		{
		against = uniform(0, ((2 * population) - 1));
		win[j] = against;
		}
		if (cost[z]<cost[against])
		winNumber[z] = winNumber[z] + 1;
		}
		}*/

		long double sort1[30], sort2[30], sort3;
		int sort4;
		for (j = 0; j<2 * population; j++)
		{
			change = 0;

			for (z = 0; z < 2 * population; z++){
				for (l = 0; l<2 * population - 1; l++)
				{
					if (cost[l]>cost[l + 1])
					{
						for (int abc = 0; abc < 30; abc++)
							sort1[abc] = (*pold)[l][abc];
						for (int abc = 0; abc < 30; abc++)
							sort2[abc] = (*pe)[l][abc];
						for (int abc = 0; abc < 30; abc++)
							(*pold)[l][abc] = (*pold)[l + 1][abc];
						for (int abc = 0; abc < 30; abc++)
							(*pe)[l][abc] = (*pe)[l + 1][abc];
						for (int abc = 0; abc < 30; abc++)
							(*pold)[l + 1][abc] = sort1[abc];
						for (int abc = 0; abc < 30; abc++)
							(*pe)[l + 1][abc] = sort2[abc];

						sort3 = cost[l];
						cost[l] = cost[l + 1];
						cost[l + 1] = sort3;

						sort4 = winNumber[l];
						winNumber[l] = winNumber[l + 1];
						winNumber[l + 1] = sort4;

					}
				}
				if (change == 0)
					break;
			}

		}
		MemorizeBestSource();
		if (turn == startIFEP)
		{
			minStartIFEP = GlobalMin;
		}
		if (turn == endIFEP)
		{
			minEndIFEP = GlobalMin;
		}
	}
}
int uniform(int a, int b)
{
	return  rand() / (RAND_MAX + 1.0)*(b - a) + a;
}


long double uniformDeviate(int a)
{
	return a*(1.0 / (RAND_MAX + 1.0));
}
double checkDomain(double value)
{
	if (value>ub)
		value = ub;
	if (value<lb)
		value = lb;
	return value;
}


long double normalRV()
{
	static unsigned int counter = 0;
	static long double x1, x2;
	counter++;
	if (counter % 2 == 0)
		return x2;
start:
	double u1 = rand() / (RAND_MAX*1.0);
	double u2 = rand() / (RAND_MAX*1.0);
	double v1 = 2 * u1 - 1;
	double v2 = 2 * u2 - 1;
	double w = v1*v1 + v2*v2;
	if (w > 1) goto start;
	double y = sqrt((-2 * log(w)) / w);
	x1 = v1*y;
	x2 = v2*y;
	return x1;
}


long double cauchyRV()
{
	long double uniform = (double)rand() / ((double)RAND_MAX + 1);
	long double x = 0 + 1 * (tan(pi*(uniform - 0.5)));
	return x;

}
int found(int win[], int  j, int b)
{
	int a = 0;;
	for (int i = 0; i <= j; i++)
	{
		if (win[i] == j)
		{
			a = 1;
			break;
		}
	}
	return a;

}
