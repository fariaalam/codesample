#include<stdio.h>
#include<conio.h>
#include<string.h>
#include<stdlib.h>
#include<time.h>
#include<graphics.h>
#include<dos.h>

void printing(char[],char[]);

void bubble1(char []);
void bubble2(char []);
void game();
void drowning(int);
char First();
void hangman();
int score=0;

//void highscore(int score);
void help();

char f1[10],f2[10],f3[10],f4[10];

int d1=0, d2=0,d3=0,d4=0;
void main()
{
    int gd = DETECT,gm;
    initgraph(&gd, &gm, "C:\\TC\\BGI");
    int ch;
    ch=First()-'0';
   // printf("%d",ch);
   // int level=1;

	switch(ch){
		case 1:
			cleardevice();
			setbkcolor(LIGHTMAGENTA);
			setcolor(RED);
			rectangle(320,0,640,480);
			setfillstyle(SOLID_FILL,LIGHTGRAY);
			floodfill(340,100,RED);
			game();
			break;
	/*       case 2:
			highscore();  */
	       case 3:
			help();
			break;
	       case 4:
			exit(1);
			break;
		default:
			break;

	       }

       getch();
       closegraph();

	}




 char First(){
     char ch;
     char str[50];
     int i,j,k,l;
     setbkcolor(DARKGRAY);
     cleardevice();

     setcolor(RED);
     settextstyle(1,0,3);
     outtextxy(150,200,"Group members of this project are");
     for(i=0;i<160;i++){
     setcolor(RED);
     outtextxy(i,250,"Faria Alam -12.01.04.155");
     delay(20);
     setcolor(DARKGRAY);
     outtextxy(i,250,"Faria Alam -12.01.04.155");
     }
     setcolor(RED);
     outtextxy(160,250,"Faria Alam -12.01.04.155");
     for(j=0;j<160;j++){
	setcolor(RED);
     outtextxy(j,280,"Mehbuba Sultana -11.02.04.103");
     delay(20);
     setcolor(DARKGRAY);
     outtextxy(j,280,"Mehbuba Sultana -11.02.04.103");
     }
     setcolor(RED);
     outtextxy(160,280,"Mehbuba Sultana -11.02.04.103");
     for(k=0;k<160;k++){
     setcolor(RED);
     outtextxy(k,310,"Nowrin Zaman -12.01.04.134");
     delay(20);
     setcolor(DARKGRAY);
     outtextxy(k,310,"Nowrin Zaman -12.01.04.134");
     }
     setcolor(RED);
     outtextxy(160,310,"Nowrin Zaman -12.01.04.134");
     cleardevice();
     settextstyle(1,0,3);
     outtextxy(190,30,"The Name of Our Project");
     strcpy(str,"HANG MAN");
     for(l=0;l<50;l++){
     setcolor(RED);
     rectangle(213,120-l,426,180-l);
     settextstyle(1,0,4);
     outtextxy(234,106+14+10-l,str);
     delay(20);
     setcolor(DARKGRAY);
     rectangle(213,120-l,426,180-l);
     settextstyle(1,0,4);
     outtextxy(234,106+14+10-l,str);
     }
     setcolor(RED);
     rectangle(213,60,426,120);
     settextstyle(1,0,4);
     outtextxy(234,70,str);


     rectangle(210,200,430,400);
     settextstyle(4,0,4);
     outtextxy(220,210,"1.New Game");
     settextstyle(4,0,4);
     outtextxy(220,250,"2.High Score");
     settextstyle(4,0,4);
     outtextxy(220,290,"3.Help");
     settextstyle(4,0,4);
     outtextxy(220,330,"4.Exit");
     settextstyle(1,0,4);
     outtextxy(150,430,"Press your choice:");
     while(1){

	 ch=getch();


	 if(ch=='1'||ch=='2'||ch=='3'||ch=='4'){

	      break;
	   }

	}

     return ch;
   }
void highscore(int score)
{
clrscr();
int x;
//int score;
FILE *fp1;
fp1=fopen("C:\\TC\\FILE.txt","w");
fscanf(fp1,"%d",&x);
fclose(fp1);
printf("%d",x);
//if (score>x);

}



void help(){
   int i;
   char ch;
   clrscr();
   setcolor(1);
settextstyle(3,0,4);
outtextxy(10,10,"GAME INSTRUCTION");

   for(i=0;i<=300;i++)
   {
	 setcolor(i);
	 outtextxy(i,30,"=");
	 settextstyle(5,0,4);
	 setcolor(i);
	 outtextxy(10,60,"To start the game we must press 1.Then we");
	 outtextxy(10,100,"will see a bubble there will be a selected");
	 outtextxy(10,140,"hidden word in the bubble's box we must fill up");
	 outtextxy(10,180,"or guess the letters literally for each correct");
	 outtextxy(10,220,"the score will be increased by 5.we have to press");
	 outtextxy(10,260,"the letter.");
	 outtextxy(350,320,"Faria Alam");
	 outtextxy(350,360,"Mehbuba Sultana");
	 outtextxy(350,400,"Khandoker Nowrin Zaman");
    }

getch();
}





 void game(){
	FILE *fp1;
	char wd[20];
	char *ptr,wdr[100][20];
	int nw=0;

	fp1=fopen("C:\\TC\\BIN\\WORD.lst","r");
	if(fp1!=NULL) {
		while(nw<=20){
			fgets(wd,20,fp1);
			strcpy(wdr[nw],wd);
		//	 printf("%s \n",wdr[nw]);
			nw++;
		}
		fclose(fp1);
	}
	else{
		printf("error occured");
	}

    int fw,i,l;
    randomize();
    fw=rand()% nw;
    printf("%d\n",fw);
    char choice[20];
    l=strlen(wdr[fw]);
    for(i=0;i<l;i++){

	   choice[i]=wdr[fw][i];

	}

	hangman();
	setcolor(RED);
	settextstyle(1,0,3);
	outtextxy(460,10,"Total Chances:6");
	bubble1(choice);

 }

void bubble1(char choice[100]){
    char input,r1[10],s[10],n[10],name[100],lc[100];
    int i,p,ln,j,chances=0,k;
    ln=strlen(choice);
	bubble2(choice);
    int mistake=0,match=0,left=6;

    while(chances<6&&left>0){
		input=(char)getch();
		for(j=0;j<ln;j++){
			if(choice[j]==input){
				if(choice[2]==input||choice[4]==input){

					break;
				}
				match=1;

				setcolor(LIGHTMAGENTA);
				sprintf(lc,"left chance:%d",left);
				settextstyle(1,0,3);
				outtextxy(20,20,lc);
				left=left-1;

				setcolor(RED);
				sprintf(lc,"left chance:%d",left);
				settextstyle(1,0,3);
				outtextxy(20,20,lc);
				break;
			}
		}
		if(match==1){
			setcolor(LIGHTMAGENTA);
			sprintf(s,"Score:%d",score);
			settextstyle(1,0,3);
			outtextxy(80,80,s);
			score=score+5;

			setcolor(RED);
			sprintf(s,"Score:%d",score);
			settextstyle(1,0,3);
			outtextxy(80,80,s);
			sprintf(r1,"%c",choice[j]);
			printing(r1,choice);
			if(d1==1&&d2==1&&d3==1&&d4==1){
			   setcolor(RED);
			   settextstyle(1,0,1);
			   outtextxy(10,340,"HURRAY!...You Won");
			   break;
			}
			match=0;
		}
		else if(match==0){
			mistake++;
			drowning(mistake);
			setcolor(LIGHTMAGENTA);
			sprintf(lc,"left chance:%d",left);
			settextstyle(1,0,3);
			outtextxy(20,20,lc);
			left=left-1;
			setcolor(RED);
			sprintf(lc,"left chance:%d",left);
			settextstyle(1,0,3);
			outtextxy(20,20,lc);
		}
		else{
			match=0;
			continue;
		}
		chances++;
	}

	setcolor(RED);
	settextstyle(1,0,1);
	outtextxy(10,390,"GameOver...! ");
	outtextxy(10,410,"Want to play again?y/n");
	char a,b;
	int f=0;
	a=(char)getch();
	if(a=='y'){
	     d1=0;d2=0;d3=0;d4=0;
	     strcpy(f1,"");
	     strcpy(f2,"");
	     strcpy(f3,"");
	     strcpy(f4,"");
	     cleardevice();
	     setbkcolor(LIGHTMAGENTA);
	     setcolor(RED);
	     rectangle(320,0,640,480);
	     setfillstyle(SOLID_FILL,LIGHTGRAY);
	     floodfill(340,100,RED);
	     game();
	 }

	 if(a=='n'){
	     outtextxy(10,430,"Enter your name:");
	     for(k=0;k<5;k++){
		  b=(char)getch();
		  sprintf(n,"%c",b);
		  outtextxy(10+f,450,n);
		  f=f+10;
		  name[k]=b;

	   }
	}
    }


 void bubble2(char choice[100]){

	int i,j;
	char t[5],t1[5];

	sprintf(t,"%c",choice[2]);
	sprintf(t1,"%c",choice[4]);
	for(i=420;i>290;i--){
		setcolor(RED);
		ellipse(140,i,0,360,80,40);
		setfillstyle(SOLID_FILL,LIGHTCYAN);
		floodfill(140,i,RED);
		rectangle(70,i,90,i+15);
		rectangle(94,i,114,i+15);
		rectangle(118,i,138,i+15);
		rectangle(142,i,162,i+15);
		rectangle(166,i,186,i+15);
		rectangle(190,i,210,i+15);
		setfillstyle(SOLID_FILL,LIGHTMAGENTA);
		floodfill(71,i+8,RED);

		floodfill(95,i+8,RED);
		floodfill(119,i+8,RED);
		settextstyle(1,0,1);
		outtextxy(120,i-4,t);
		floodfill(144,i+8,RED);
		floodfill(168,i+8,RED);
		settextstyle(1,0,1);
		outtextxy(170,i-4,t1);
		floodfill(192,i+8,RED);


		delay(30);
		setcolor(LIGHTMAGENTA);
		ellipse(140,i,0,360,80,40);
		setfillstyle(SOLID_FILL,LIGHTMAGENTA);
		floodfill(140,i,LIGHTMAGENTA);
		outtextxy(120,i-4,t);
		outtextxy(170,i-4,t1);

	}




    setcolor(RED);
    ellipse(140,290,0,360,80,40);
    setfillstyle(SOLID_FILL,LIGHTCYAN);
    floodfill(140,290,RED);
    rectangle(70,290,90,305);
    rectangle(94,290,114,305);
    rectangle(118,290,138,305);
    rectangle(142,290,162,305);
    rectangle(166,290,186,305);
    rectangle(190,290,210,305);

    setfillstyle(SOLID_FILL,LIGHTMAGENTA);
    floodfill(71,298,RED);
    floodfill(95,298,RED);
    floodfill(119,298,RED);
    outtextxy(120,286,t);
    floodfill(144,298,RED);
    floodfill(168,298,RED);
    outtextxy(170,286,t1);
    floodfill(192,298,RED);

 }

 void printing(char r1[10],char choice[100]){


    int j,lnt;
    char t[5],t1[5];
    lnt=strlen(choice);


	sprintf(t,"%c",choice[2]);
	sprintf(t1,"%c",choice[4]);



      if(r1[0]==choice[0]){
	 sprintf(f1,"%c",r1[0]);
	 setcolor(RED);
	 ellipse(140,290,0,360,80,40);
	 setfillstyle(SOLID_FILL,LIGHTCYAN);
	 floodfill(140,290,RED);
	 rectangle(70,290,90,305);
	 rectangle(94,290,114,305);
	 rectangle(118,290,138,305);
	 rectangle(142,290,162,305);
	 rectangle(166,290,186,305);
	 rectangle(190,290,210,305);

	 setfillstyle(SOLID_FILL,LIGHTMAGENTA);
	settextstyle(1,0,1);
	floodfill(71,298,RED);
	outtextxy(74,286,f1);
	floodfill(95,298,RED);
    //	outtextxy(96,286,f2);
	floodfill(119,298,RED);
	outtextxy(120,286,t);
	floodfill(144,298,RED);
  //	outtextxy(144,286,f3);
	floodfill(168,298,RED);
	outtextxy(170,286,t1);
	floodfill(192,298,RED);
//	outtextxy(192,286,f4);
	d1=1;

     }


     if(r1[0]==choice[1]){

	sprintf(f2,"%c",r1[0]);
	setcolor(RED);
	ellipse(140,290,0,360,80,40);
	setfillstyle(SOLID_FILL,LIGHTCYAN);
	floodfill(140,290,RED);
	rectangle(70,290,90,305);
	rectangle(94,290,114,305);
	rectangle(118,290,138,305);
	rectangle(142,290,162,305);
	rectangle(166,290,186,305);
	rectangle(190,290,210,305);

	setfillstyle(SOLID_FILL,LIGHTMAGENTA);
	settextstyle(1,0,1);
	floodfill(71,298,RED);
	outtextxy(74,286,f1);
	floodfill(95,298,RED);
	outtextxy(96,286,f2);
	floodfill(119,298,RED);
	outtextxy(120,286,t);
	floodfill(144,298,RED);
   //	outtextxy(144,286,f3);
	floodfill(168,298,RED);
	outtextxy(170,286,t1);
	floodfill(192,298,RED);
   //	outtextxy(192,286,f4);
	d2=1;
    }

    if(r1[0]==choice[3]){

	sprintf(f3,"%c",r1[0]);
	setcolor(RED);
	ellipse(140,290,0,360,80,40);
	setfillstyle(SOLID_FILL,LIGHTCYAN);
	floodfill(140,290,RED);
	rectangle(70,290,90,305);
	rectangle(94,290,114,305);
	rectangle(118,290,138,305);
	rectangle(142,290,162,305);
	rectangle(166,290,186,305);
	rectangle(190,290,210,305);

	setfillstyle(SOLID_FILL,LIGHTMAGENTA);
	settextstyle(1,0,1);
	floodfill(71,298,RED);
	outtextxy(74,286,f1);
	floodfill(95,298,RED);
	outtextxy(96,286,f2);
	floodfill(119,298,RED);
	outtextxy(120,286,t);
	floodfill(144,298,RED);
	outtextxy(144,286,f3);
	floodfill(168,298,RED);
	outtextxy(170,286,t1);
	floodfill(192,298,RED);
    //	outtextxy(192,286,f4);
	d3=1;
    }

    if(r1[0]==choice[5]){

	sprintf(f4,"%c",r1[0]);
	setcolor(RED);
	ellipse(140,290,0,360,80,40);
	setfillstyle(SOLID_FILL,LIGHTCYAN);
	floodfill(140,290,RED);
	rectangle(70,290,90,305);
	rectangle(94,290,114,305);
	rectangle(118,290,138,305);
	rectangle(142,290,162,305);
	rectangle(166,290,186,305);
	rectangle(190,290,210,305);

	setfillstyle(SOLID_FILL,LIGHTMAGENTA);
	settextstyle(1,0,1);
	floodfill(71,298,RED);
	outtextxy(74,286,f1);
	floodfill(95,298,RED);
	outtextxy(96,286,f2);
	floodfill(119,298,RED);
	outtextxy(120,286,t);
	floodfill(144,298,RED);
	outtextxy(144,286,f3);
	floodfill(168,298,RED);
	outtextxy(170,286,t1);
	floodfill(192,298,RED);
	outtextxy(192,286,f4);
	d4=1;
   }


}


void hangman(){


    setcolor(RED);
    rectangle(320,0,640,264);
    setfillstyle(SOLID_FILL,LIGHTGRAY);
    floodfill(340,100,RED);

    setcolor(RED);
    rectangle(320,264,640,480);   //pani
    setfillstyle(SOLID_FILL,CYAN);
    floodfill(330,266,RED);

  //  hangman start

    setcolor(RED);
    ellipse(460,90,0,360,20,26);
    circle(452,85,3);
    circle(466,85,3);
    setfillstyle(SOLID_FILL,GREEN);
    floodfill(452,85,RED);
    floodfill(466,85,RED);
    arc(460,95,200,340,10);
    line(460,118,460,230);  //body
    line(460,230,420,260);  //bam pa
    line(460,230,505,260);  //dan pa
    line(460,120,410,160); //bam hat
    line(460,120,510,160);    //dan hat

  }

void drowning(int ms){

	 float i;

	setcolor(LIGHTGRAY);
	if((ms-1)==0){
		arc(460,95,200,340,10);
	}
	else if((ms-1)>=1&& (ms-1)<=3){
		line(450,100,470,100);
	}
	else if((ms-1)>=3&&(ms-1)<=5){
		arc(460,105,20,160,10);
	}
	else if((ms-1)>5){
		arc(460,105,20,160,10);
		line(452,90,452,120);//tears eye1
		line(466,90,466,120); //tears eye2
	}


	if(ms==0) {
		setcolor(RED);
		rectangle(320,0,640,264);
		setfillstyle(SOLID_FILL,LIGHTGRAY);
		floodfill(340,100,RED);

		ellipse(460,90,0,360,20,26); //head
		circle(452,85,3);
		circle(466,85,3);  //eye
		setfillstyle(SOLID_FILL,GREEN);
		floodfill(452,85,RED);
		floodfill(466,85,RED);
		line(460,118,460,230);  //body
		line(460,230,420,260);  //bam pa
		line(460,230,505,260);  //dan pa
		line(460,120,410,160); //bam hat
		line(460,120,510,160);    //dan hat

		arc(460,95,200,340,10);

	}
	else if(ms>=1&&ms<3) {
		if(ms==1){
		       setcolor(RED);
		       rectangle(320,0,640,264);
		       setfillstyle(SOLID_FILL,LIGHTGRAY);
		       floodfill(340,100,RED);

		       ellipse(460,90,0,360,20,26); //head
		       circle(452,85,3);
		       circle(466,85,3);  //eye
		       setfillstyle(SOLID_FILL,GREEN);
		       floodfill(452,85,RED);
		       floodfill(466,85,RED);
		       line(460,118,460,230);  //body
		       line(460,230,420,260);  //bam pa
		       line(460,230,505,260);  //dan pa
		       line(460,120,410,160); //bam hat
		       line(460,120,510,160);    //dan hat

		       line(450,100,470,100);

		 }
		 if(ms==2){

		       setcolor(RED);
		       line(455,100,465,100);
		 }

	}
	else if(ms>=3&&ms<5) {
		 setcolor(RED);
		 arc(460,105,20,160,10);

	}
	else if(ms>=5){
		 setcolor(RED);
		 arc(460,105,20,160,10);
		 setcolor(CYAN);
		 line(452,90,452,120);//tears eye1
		 line(466,90,466,120); //tears eye2

		 if(ms>5){
		       setcolor(CYAN);
		       arc(460,105,20,160,10);
		       setcolor(CYAN);
		       line(452,90,452,120);//tears eye1
		       line(466,90,466,120); //tears eye2

		  }

	}


	setcolor(RED);
	rectangle(321,264-(ms-1)*33,640,480);   //pani
	setfillstyle(SOLID_FILL,CYAN);
	floodfill(330,266,RED);

	i=0;


	while(i<=33){
		setcolor(CYAN);
		rectangle(321,264-(ms-1)*33-i,640,480);   //pani
		setfillstyle(SOLID_FILL,CYAN);
		floodfill(330,266-(ms-1)*33-i,CYAN);
		i=i+0.5;
		delay(30);
	}



 }



































































