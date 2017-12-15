import numpy as np
from sklearn.utils import shuffle
from sklearn.metrics import accuracy_score,confusion_matrix
from sklearn.metrics import precision_recall_fscore_support
from sklearn.model_selection import train_test_split,cross_val_score
from sklearn.svm import SVC
from sklearn.ensemble import RandomForestClassifier
from sklearn.tree import DecisionTreeClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.cluster import KMeans
from sklearn.naive_bayes import GaussianNB

dataset=[]
file=open("spambase.data","r");
line=file.readline();
while line:
     line=line[:len(line)-1];
     row=line.split(",");
     data=[float(value) for value in row]
     dataset.append(data);
     line=file.readline();
     
dataset=shuffle(dataset)
data=[];
label=[];
for i in range(0,len(dataset)):
     row=dataset[i];
     data.append(row[:len(row)-1]);
     label.append(int(row[len(row)-1]));


x_train,x_test,y_train,y_test=train_test_split(data,label,test_size=.3,random_state=0)
     
def predict1():
     
     svmclf=SVC();
     svmclf.fit(x_train, y_train);
     svm_result=svmclf.predict(x_test);

     rfclf=RandomForestClassifier();
     rfclf.fit(x_train, y_train);
     rf_result=rfclf.predict(x_test);
     
     dtclf=DecisionTreeClassifier();
     dtclf.fit(x_train, y_train);
     dt_result=dtclf.predict(x_test);

     knclf=KNeighborsClassifier(n_neighbors=3);
     knclf.fit(x_train, y_train);
     kn_result=knclf.predict(x_test);

     kmclf=KMeans(n_clusters=2);
     kmclf.fit(x_train, y_train);
     km_result=kmclf.predict(x_test);

     gnbclf=GaussianNB();
     gnbclf.fit(x_train, y_train);
     gnb_result=gnbclf.predict(x_test);

     return svm_result,rf_result,dt_result,kn_result,km_result,gnb_result;

def voting():
     svm,rf,dt,kn,km,gnb=predict1();
     label=[]
     for i in range(0,len(y_test)):
          s=svm[i]+rf[i]+dt[i]+kn[i]+km[i]+gnb[i];
          if s/6>=.6:
               label.append(1);
          else:
               label.append(0);
                 
     score=accuracy_score(y_test,label);
     print("Accuracy on test email: "+str(score));
     print("Confusion matrix :\n"+str(confusion_matrix(y_test,label)));
     res=precision_recall_fscore_support(y_test,label,average=None);
     print("Precision : "+str(res[0])+" Recall : "+str(res[1])+" F1-Score : "+str(res[2]));
     
if __name__=="__main__":
     voting();
