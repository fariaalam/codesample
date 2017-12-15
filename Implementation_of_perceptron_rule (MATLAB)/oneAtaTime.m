function [  WO ] = oneAtaTime(Y)
[row,column]=size(Y);

WO=ones(1,column);
Tw=WO';
c=0;
iterO=0;
tt=clock;
tt=tt(6);
while(c~=row)
    if(iterO>=70000)
     break;
    end    
    for i=1:row
       iterO=iterO+1; 
       m=Y(i,:)*Tw(:,:);
       if(m<=0)
          WO= WO+0.01*Y(i,:);
            Tw=WO';
       end 
       if(m>0)
          c=c+1; 
       end    
    end
    if(c~=row)
     c=0;
    end    
end 
tt1=clock;
tt1=tt1(6);
tt1=tt1-tt

iterO



end

