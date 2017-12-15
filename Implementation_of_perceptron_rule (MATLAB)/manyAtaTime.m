function [ WM ] = manyAtaTime(Y)

[row,column]=size(Y);
sumY=ones(1,column);
WM=ones(1,column);
Twm=WM';
iterationM=0;
cm=0;
t=clock;
t=t(6);
while(cm~=row)
    x=0;
    if(iterationM>=70000)
      break;
    end    
    for j=1:row
        iterationM=iterationM+1;
       mm=Y(j,:)*Twm(:,:);
       if(mm<=0)
          x=x+1;   
          sumY=sumY+Y(j,:);
       end
       if(mm>0)
        cm=cm+1;    
       end    
    end
    if(x>0)
        WM= WM+0.01*sumY(1,:);
        Twm=WM';
        cm=0;
        sumY=0;
    end
  
end    
t1=clock;
t1=t1(6);
t1=t1-t
 iterationM


 

end

