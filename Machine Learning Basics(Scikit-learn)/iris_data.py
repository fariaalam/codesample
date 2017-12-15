from sklearn import datasets
import numpy as np
from sklearn.utils import shuffle
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
x=np.array(x);
y=np.array(y);

def sigmoid(data):
    return (1/(1+np.exp(data)))
def dsigmoid(data):
    return sigmoid(data)*(1-sigmoid(data))
