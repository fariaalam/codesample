

 A=zeros(2,30);
 B=zeros(2,30);
myfile=fopen('E:\CSE 4.2\pattern recognition\MATLAB Learning Tutorials\class1_30.txt','r');
A=fscanf(myfile,'%f %f',size(A));
myfile=fopen('E:\CSE 4.2\pattern recognition\MATLAB Learning Tutorials\class2_30.txt','r');
B=fscanf(myfile,'%f %f',size(B));
% A=[1 1 4 1;1 -1 5 -2 ];
% B=[2 0 2 1;2.5 2 3 2 ];
A=A';
B=B';
figure
x=A(:,1);
y=A(:,2);
plot(x,y,'b*')
hold
x=B(:,1);
y=B(:,2);
plot(x,y,'g*')


title('plotting 30 samples with 0.01 ')

AB=vertcat(A,B);
AB
[abrow,abcolumn ]=size(AB);
Y=zeros(abrow,6);
[row,column]=size(Y);



for i=1:row
    
        for j=1:column
            if(j==1)
              Y(i,j)=AB(i,j).^2;
            end 
             if(j==2)
              Y(i,j)=AB(i,j).^2;
             end 
             if(j==3)
              Y(i,j)=AB(i,j-2)*AB(i,j-1);
             end 
            if(j==4||j==5)
              Y(i,j)=AB(i,j-3);
            end
            if(j==column)
               Y(i,j)=1; 
            end
        end    
 end
Y    
%normalize

%one at a time
for i=(row/2)+1:row
   for j=1:column
      Y(i,j)=Y(i,j)*-1; 
   end    
end




 WO=oneAtaTime(Y);
 WO;
 


 WM=manyAtaTime(Y);
 WM;
 
  syms x1 x2;
s=sym(WO(1,1)*x1*x1+WO(1,2)*x2*x2+WO(1,3)*x1*x2+WO(1,4)*x1+WO(1,5)*x2+WO(1,6));
s2=solve(s,x2);
s2
xvals1=[-10:0.01:10];
xvals2(1,:)=subs(s2(2),x1,xvals1);
plot(xvals1,xvals2(1,:),'k');

syms x1 x2;
s=sym(WM(1,1)*x1*x1+WM(1,2)*x2*x2+WM(1,3)*x1*x2+WM(1,4)*x1+WM(1,5)*x2+WM(1,6));
s2=solve(s,x2);
xvals1=[-10:0.01:10];
xvals2(1,:)=subs(s2(2),x1,xvals1);
plot(xvals1,xvals2(1,:),'m');
legend('class 1','class 2','one at a time','many at a time')
% Tw=WO';
% c=0;
% iterO=0;
% while(c~=row)
%     if(iterO>=70000)
%      break;
%     end    
%     for i=1:row
%        iterO=iterO+1; 
%        m=Y(i,:)*Tw(:,:);
%        if(m<=0)
%           WO= WO+0.05*Y(i,:);
%             Tw=WO';
%        end 
%        if(m>0)
%           c=c+1; 
%        end    
%     end
%     if(c~=row)
%      c=0;
%     end    
% end   
% WO
% iterO
%  syms x1 x2;
% s=sym(WO(1,1)*x1*x1+WO(1,2)*x2*x2+WO(1,3)*x1*x2+WO(1,4)*x1+WO(1,5)*x2+WO(1,6));
% s2=solve(s,x2);
% s2
% xvals1=[-10:0.01:10];
% xvals2(1,:)=subs(s2(2),x1,xvals1);
% plot(xvals1,xvals2(1,:),'k');

%finish

%many at atime
% sumY=ones(1,column);
% 
% WM=ones(1,column);
% Twm=WM';
% iterationM=0;
% cm=0;
% while(cm~=row)
%     x=0;
%     if(iterationM>=70000)
%       break;
%     end    
%     for j=1:row
%         iterationM=iterationM+1;
%        mm=Y(j,:)*Twm(:,:);
%        if(mm<=0)
%           x=x+1;   
%           sumY=sumY+Y(j,:);
%        end
%        if(mm>0)
%         cm=cm+1;    
%        end    
%     end
%     if(x>0)
%         WM= WM+0.05*sumY(1,:);
%         Twm=WM';
%         cm=0;
%         sumY=0;
%     end
%   
% end        
%  WM
%  iterationM
% figure
% x=A(:,1);
% y=A(:,2);
% plot(x,y,'b*')
% hold
% x=B(:,1);
% y=B(:,2);
% plot(x,y,'g*')
% 
%  syms x1 x2;
% s=sym(WM(1,1)*x1*x1+WM(1,2)*x2*x2+WM(1,3)*x1*x2+WM(1,4)*x1+WM(1,5)*x2+WM(1,6));
% s2=solve(s,x2);
% xvals1=[-10:0.01:10];
% xvals2(1,:)=subs(s2(2),x1,xvals1);
% plot(xvals1,xvals2(1,:),'k');

 
 %finish
    
    







