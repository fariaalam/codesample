function idDetection
create();
I=imread('E:\CSE 4.2\image_Processing\12.01.04.155\id.jpg');
I=imrotate(I,90);
figure
imshow(I);
title('Rotated image')
[row, column]=size(I);
row
column
figure
O=I;
imshow(O);
title('Original Image')

I=imresize(I,[350,512],'nearest');
figure
imshow(I);
title('Resized Image')

I=rgb2gray(I);
G=I;
figure
imshow(G);
title('Gray Image')



%histogram
 [row,col]=size(I);
    H=zeros(1,256);
    for i=1:row
        for j=1:col
            H(I(i,j)+1)=H(I(i,j)+1)+1;
        end
    end
    CH=zeros(1,256);
    CH(1)=H(1);
    for i=2:256
        CH(i)=CH(i-1)+H(i);
    end
    S=zeros(1,256);
    for i=1:256
        S(i)=round((double(CH(i))/(row*col))*255);
    end
    for i=1:row
        for j=1:col
            I(i,j)=S(I(i,j)+1);
        end
    end
    figure
    bar(H)
    title('Histogram of the image')
    figure
    bar(S)
    title('Equalized histogram of the image')
%histogram end
figure 
imshow(I);
title('Histogram Equalized Image')

I=imcrop(I,[165,200,165,40]);
figure
imshow(I);
title('Segmentation of Full Id')

%thresholding
[sizex, sizey]=size(I);
for i=1:sizex
    for j=1:sizey
       if(I(i,j)>=80)
          I(i,j)=255;
       else
           I(i,j)=0;
       end
    end
end 
figure
imshow(I);
title('Segmentation of Id after Thresholding')
%thresholding end

d1=imcrop(I,[4,12,9,20])
d1=imresize(d1,[42 24],'nearest');
d1=bwmorph(d1,'thicken');

d2=imcrop(I,[18,12,11,20])
d2=imresize(d2,[42 24],'nearest');
d2=bwmorph(d2,'thicken');

d3=imcrop(I,[38,12,12,20])
d3=imresize(d3,[42 24],'nearest');
%d3=bwmorph(d3,'thicken');

d4=imcrop(I,[53,12,9,20])
d4=imresize(d4,[42 24],'nearest');
d4=bwmorph(d4,'thicken');
 
d5=imcrop(I,[74,12,10,20])
 d5=imresize(d5,[42 24],'nearest');
 d5=bwmorph(d5,'thicken');
 
d6=imcrop(I,[88,12,12,20])
d6=imresize(d6,[42 24],'nearest');
d6=bwmorph(d6,'thicken');

d7=imcrop(I,[110,12,10,20])
d7=imresize(d7,[42 24],'nearest');
d7=bwmorph(d7,'thicken');

d8=imcrop(I,[125,12,12,20])
d8=imresize(d8,[42 24],'nearest');
d8=bwmorph(d8,'thicken');
 
d9=imcrop(I,[140,12,12,20])
d9=imresize(d9,[42 24],'nearest');
d9=bwmorph(d9,'thicken');

figure
subplot(3,3,1),imshow(d1);
subplot(3,3,2),imshow(d2);
subplot(3,3,3),imshow(d3);
subplot(3,3,4),imshow(d4);
subplot(3,3,5),imshow(d5);
subplot(3,3,6),imshow(d6);
subplot(3,3,7),imshow(d7);
subplot(3,3,8),imshow(d8);
subplot(3,3,9),imshow(d9);


digit=zeros(1,9);
 dr1=read_letter(d1);
 dr1
 digit(1)=str2num(dr1);
 
 dr2=read_letter(d2);
 dr2
 digit(2)=str2num(dr2);
 
 dr3=read_letter(d3);
 dr3
 digit(3)=str2num(dr3);
 
 dr4=read_letter(d4);
 dr4
 digit(4)=str2num(dr4);
 
 dr5=read_letter(d5);
 dr5
 digit(5)=str2num(dr5);
 
 dr6=read_letter(d6);
 dr6
 digit(6)=str2num(dr6);
 
 dr7=read_letter(d7);
 dr7
 digit(7)=str2num(dr7);
 
 dr8=read_letter(d8);
 dr8
 digit(8)=str2num(dr8);
 
 dr9=read_letter(d9);
 dr9
 digit(9)=str2num(dr9);
 
   myfile=fopen('E:/CSE 4.2/image_Processing/12.01.04.155/id.txt','w');
    fprintf(myfile,'Detected Id is %d%d.%d%d.%d%d.%d%d%d',digit);
 
end


function create
    one=imread('1.bmp');  two=imread('2.bmp');
    three=imread('3.bmp');four=imread('4.bmp');
    five=imread('5.bmp'); six=imread('6.bmp');
    seven=imread('7.bmp');eight=imread('8.bmp');
    nine=imread('9.bmp'); zero=imread('0.bmp');
    number=[one two three four five...
        six seven eight nine zero];
    character=[number];
    templates=mat2cell(character,42,[24 24 24 24 24 24 24 24 24 24]);
    %celldisp(templates)
    save ('E:\CSE 4.2\image_Processing\12.01.04.155\templates','templates');
end

function letter=read_letter(imagn)
    comp=[];
    load templates
    for n=1:10
        sem=corr2(templates{1,n},imagn);
        comp=[comp sem];
    end
    comp
    vd=find(comp==max(comp));
    if vd==1
        letter='1';
    elseif vd==2
        letter='2';
    elseif vd==3
        letter='3';
    elseif vd==4
        letter='4';
    elseif vd==5
        letter='5';
    elseif vd==6
        letter='6';
    elseif vd==7
        letter='7';
    elseif vd==8
        letter='8';
    elseif vd==9
        letter='9';
    elseif vd==10
        letter='0';
    end
end

