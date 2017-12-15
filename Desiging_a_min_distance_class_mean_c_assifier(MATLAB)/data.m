A=zeros(2,100)
B=zeros(2,100)
myfile=fopen('E:\CSE 4.2\pattern recognition\MATLAB Learning Tutorials\class1.txt','r');
A=fscanf(myfile,'%f %f',size(A));
myfile=fopen('E:\CSE 4.2\pattern recognition\MATLAB Learning Tutorials\class2.txt','r');
B=fscanf(myfile,'%f %f',size(B));

meanA=mean(A,2)
meanB=mean(B,2)

[sizeArow,sizeAcolumn]=size(A);
[sizeBrow,sizeBcolumn]=size(A);
X=[-1 -1;3 2;-2 1;8 2];
[sizeXrow,sizeXcolumn]=size(X)




figure
x=A(1,:);
y=A(2,:);
plot(x,y,'b*')
hold
x=B(1,:);
y=B(2,:);
plot(x,y,'r*')

x1=meanA(1,:);
y1=meanA(2,:);
x2=meanB(1,:);
y2=meanB(2,:);
plot(x1,y1,'bd');
plot(x2,y2,'rd');
for i=1:sizeXrow
      g1=sqrt((meanA(1,1)-X(i,1)).^2+(meanA(2,1)-X(i,2)).^2);
      g2=sqrt((meanB(1,1)-X(i,1)).^2+(meanB(2,1)-X(i,2)).^2);
      if(g1<g2)
          plot(X(i,1),X(i,2),'bo')
      else
          plot(X(i,1),X(i,2),'ro')
      end
end

Min=[min(A(1,:)) min(B(1,:)) min(X(:,1))];
Min=min(Min)
Max=[max(A(1,:)) max(B(1,:)) max(X(:,1))];
Max=max(Max)
BX=Min:.12:Max;
x=(meanA(1,1)+meanB(1,1))/2;
y=(meanA(2,1)+meanB(2,1))/2
meanA(1,1)
meanA(2,1)
m=((meanA(2,1)-y)/(meanA(1,1)-x));
m=-(1/m);
b=y-m*x;


BY=zeros(1,length(BX));
for i=1:length(BX)
    BY(i)=m*BX(i)+b;
end
plot(BX,BY,'-+','MarkerEdgeColor','c','MarkerFaceColor','b');



title('Using Distance Function')
figure
x=A(1,:);
y=A(2,:);
plot(x,y,'b*')
hold
x=B(1,:);
y=B(2,:);
plot(x,y,'r*')
plot(x1,y1,'bd');
plot(x2,y2,'rd');
for i=1:sizeXrow
   Y=[X(i,1);X(i,2)];
   g1=meanA'*Y -.5*meanA'*meanA;
   g2=meanB'*Y -.5*meanB'*meanB;
   if(g1>g2)
       plot(X(i,1),X(i,2),'bo')
   else
       plot(X(i,1),X(i,2),'ro')
   end
end
title('Using Discriminate Function')


BY=zeros(1,length(BX));
for i=1:length(BX)
    BY(i)=m*BX(i)+b;
end
plot(BX,BY,'-+','MarkerEdgeColor','c','MarkerFaceColor','b');