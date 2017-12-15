import csv
import numpy as np
from sklearn.model_selection import train_test_split

def getReadyData():
    x=[]
    y_t=[]
    n=1;
    with open("train_test.csv") as trainFile:
        reader=csv.reader(trainFile);
        for row in reader:
            if n==1:
                n=2;
            else:
                a=[];
                y_t.append(int(row[0]));
                for i in range(1,len(row)):
                    a.append(int(row[i]));
                x.append(a);
                
    y=[];
    for j in range(0,len(y_t)):
        l=[0,0,0,0,0,0,0,0,0,0];
        l[y_t[j]]=1;
        y.append(l);
            
    x=np.array(x);
    y=np.array(y);
    x_train,x_test,y_train,y_test=train_test_split(x,y,test_size=.2,random_state=0)
    return x_train,x_test,y_train,y_test;
