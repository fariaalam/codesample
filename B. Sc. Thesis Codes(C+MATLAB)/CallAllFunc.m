
function CallAllFunc
    dataABC=zeros(1,1000);
    dataDE=zeros(1,1000);
    dataH1S1=zeros(1,1000);
    %dataH1S2=zeros(1,1000);
    
    generation=1:1:1000;
    
    f='Function7.txt';
    
    fileABC=fopen(strcat('E:\Thesis\Codes For Matlab\ABC\',f),'r');
    dataABC=fscanf(fileABC,'%e',size(dataABC));
    size(dataABC)
    dataABC=log10(dataABC);
    %dataABC=(dataABC);
    
    
    
    fileDE=fopen(strcat('E:\Thesis\Codes For Matlab\DE\Strategy 2\',f),'r');
    dataDE=fscanf(fileDE,'%e',size(dataDE));
    dataDE=log10(dataDE);
    %dataDE=(dataDE);
    
    
    fileH1S1=fopen(strcat('E:\Thesis\Codes For Matlab\Best Data Hybrid 1\Strategy 2\',f),'r');
    dataH1S1=fscanf(fileH1S1,'%e',size(dataH1S1));
    dataH1S1=log10(dataH1S1);
    %dataH1S1=(dataH1S1);
    
    
  %{ 
    fileH1S2=fopen(strcat('E:\Thesis\Codes For Matlab\Best Data Hybrid 1\Strategy 2\',f),'r');
    dataH1S2=fscanf(fileH1S2,'%e',size(dataH1S2));
    dataH1S2=log10(dataH1S2);
  %}

    
    figure
    plot(generation,dataABC,'k-.');
    hold on
    plot(generation,dataDE,'k--');
    plot(generation,dataH1S1,'k-');
   % plot(generation,dataH1S2,'c');

    
    xlabel('Generations---->>>>');
    ylabel('Objective Function Value---->>>>');
    legend('ABC','DE(S2)','Hybrid2'),legend('Location','SouthWest'),legend('boxoff');
end