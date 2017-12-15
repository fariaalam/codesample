from sklearn import datasets
from sklearn.utils import shuffle
from sklearn.model_selection import train_test_split,cross_val_score
from sklearn.metrics import accuracy_score,confusion_matrix
from sklearn.svm import SVC
from sklearn.linear_model import SGDClassifier
from sklearn.linear_model import RidgeClassifier
from sklearn.ensemble import AdaBoostClassifier
from sklearn.ensemble import GradientBoostingClassifier
from sklearn.ensemble import BaggingClassifier
from sklearn.ensemble import RandomForestClassifier, VotingClassifier
from sklearn.tree import DecisionTreeClassifier
from sklearn.neighbors import KNeighborsClassifier
from sklearn.cluster import KMeans
from sklearn.cluster import AgglomerativeClustering
from sklearn.naive_bayes import GaussianNB
import numpy as np



iris=datasets.load_iris();
length=len(iris.data);
maindataset=[];
for i in range(0,length):
    dataset=[];
    for j in range(0,len(iris.data[0])):
        dataset.append(iris.data[i,j])
    dataset.append(iris.target[i]);
    maindataset.append(dataset);
maindataset=shuffle(maindataset);

x=[];
y=[];
for i in range(0,length):
    data=maindataset[i];
    dataset=[];
    for j in range(0,len(maindataset[0])-1):
        dataset.append(data[j])
    x.append(dataset);
    y.append(data[len(maindataset[0])-1]);
    
x_train,x_test,y_train,y_test=train_test_split(x,y,test_size=.33,random_state=0)

dtclf=DecisionTreeClassifier();
scores=cross_val_score(dtclf,x,y,cv=5);
print("Cross Validation Scores : \n"+str(scores));
print("Mean Score : %f"%(scores.mean()));
dtclf.fit(x_train, y_train);
dt_result=dtclf.predict(x_test);
score=accuracy_score(y_test,dt_result);
print("Accuracy for Decision Tree: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(dt_result,y_test)));


svmclf=SVC();
svmclf.fit(x_train, y_train);
svm_result=svmclf.predict(x_test);
score=accuracy_score(y_test,svm_result);
print("Accuracy for SVM: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(svm_result,y_test)));


sgdclf=SGDClassifier();
sgdclf.fit(x_train, y_train);
sgd_result=svmclf.predict(x_test);
score=accuracy_score(y_test,sgd_result);
print("Accuracy for SGD: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(sgd_result,y_test)));


rclf=RidgeClassifier();
rclf.fit(x_train, y_train);
r_result=rclf.predict(x_test);
score=accuracy_score(y_test,r_result);
print("Accuracy for Ridge Classifier: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(r_result,y_test)));


abclf=AdaBoostClassifier();
abclf.fit(x_train, y_train);
ab_result=abclf.predict(x_test);
score=accuracy_score(y_test,ab_result);
print("Accuracy for AdaBoost: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(ab_result,y_test)));


gbclf=GradientBoostingClassifier();
gbclf.fit(x_train, y_train);
gb_result=gbclf.predict(x_test);
score=accuracy_score(y_test,gb_result);
print("Accuracy for GBoosting: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(gb_result,y_test)));


bclf=BaggingClassifier();
bclf.fit(x_train, y_train);
b_result=bclf.predict(x_test);
score=accuracy_score(y_test,b_result);
print("Accuracy for Bagging: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(b_result,y_test)));


rfclf=RandomForestClassifier();
rfclf.fit(x_train, y_train);
rf_result=rfclf.predict(x_test);
score=accuracy_score(y_test,rf_result);
print("Accuracy for Random Forest: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(rf_result,y_test)));


knclf=KNeighborsClassifier(n_neighbors=3);
knclf.fit(x_train, y_train);
kn_result=knclf.predict(x_test);
score=accuracy_score(y_test,kn_result);
print("Accuracy for KNeighbors: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(kn_result,y_test)));

kmclf=KMeans(n_clusters=3);
kmclf.fit(x_train, y_train);
km_result=kmclf.predict(x_test);
score=accuracy_score(y_test,km_result);
print("Accuracy for KMeans: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(km_result,y_test)));


gnbclf=GaussianNB();
gnbclf.fit(x_train, y_train);
gnb_result=gnbclf.predict(x_test);
score=accuracy_score(y_test,gnb_result);
print("Accuracy for GaussianNB: "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(gnb_result,y_test)));


acclf=AgglomerativeClustering(n_clusters=3);
acclf.fit(x_train, y_train);
ac_result=acclf.fit_predict(x_test,y=None);
score=accuracy_score(y_test,ac_result);
print("Accuracy for agglomerative clustering : "+str(score));
print("confusion matrix :\n"+str(confusion_matrix(ac_result,y_test)));






