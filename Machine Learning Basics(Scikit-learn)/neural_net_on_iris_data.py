import numpy as np
from sklearn import datasets
from sklearn.utils import shuffle
from sklearn.model_selection import train_test_split
from sklearn.metrics import accuracy_score


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
    y.append([data[len(maindataset[0])-1]]);

y=np.array(y);
a=[];
for i in range(0,len(y)):
   b=[0, 0, 0];
   b[int(y[i])]=int(y[i]);
   a.append(b);

x=np.array(x)
y=np.array(a);
    
x_train,x_test,y_train,y_test=train_test_split(x,y,test_size=.33,random_state=0)


x_train=np.array(x_test);
y_train=np.array(y_train);
x_test=np.array(x_test);
y_test=np.array(y_test)


input_neurons=4;
hidden_layer1_neurons=10;
hidden_layer2_neurons=10;
output_neurons=3;
learning_rate=0.0001;
epochs=10;


w1=np.random.randn(input_neurons,hidden_layer1_neurons);
w2=np.random.randn(hidden_layer1_neurons,hidden_layer2_neurons);
w3=np.random.randn(hidden_layer2_neurons,output_neurons);
b1=np.random.randn(hidden_layer1_neurons);
b2=np.random.randn(hidden_layer2_neurons);
b3=np.random.randn(output_neurons);

for i in range(0,epochs):
    a1=x.dot(w1)+b1;
    z1=1/(1+np.exp(-a1));
    a2=z1.dot(w2)+b2;
    z2=1/(1+np.exp(-a2));
    a3=z2.dot(w3)+b3;
    o=1/(1+np.exp(-a3));
    
    error=y-o;
    delta_output=error*o*(1-o);
    delta_layer2=delta_output.dot(w3.T)*z2*(1-z2)
    delta_layer1=delta_layer2.dot(w2.T)*z1*(1-z1)

    w1+=learning_rate*x.T.dot(delta_layer1);
    w2+=learning_rate*z1.T.dot(delta_layer2);
    w3+=learning_rate*z2.T.dot(delta_output);

    b1+=learning_rate*delta_layer1.sum(axis=0);
    b2+=learning_rate*delta_layer2.sum(axis=0);
    b3+=learning_rate*delta_output.sum(axis=0);

    
def tinput(test):
    test=np.array(test);
    a1=test.dot(w1)+b1;
    z1=1/(1+np.exp(-a1));
    a2=z1.dot(w2)+b2;
    z2=1/(1+np.exp(-a2));
    a3=z2.dot(w3)+b3;
    o=1/(1+np.exp(-a3))
    result=[];
    one_hot_result=[];
    t=0;
    f=0;
    for i in range(0,len(o)):
        row=o[i];
        s=0;
        r=[];
        c=[];
        for j in range(0,len(row)):
            s+=row[j]
        for j in range(0,len(row)):
            r.append(round(float(row[j]/s),2))
        result.append(r);
        index=r.index(max(r))
        for k in range(0,len(r)):
            if(k==index):
                c.append(1);
            else:
                c.append(0);
        if np.array_equal(c,y_test[i]) is True:
            t=t+1;
        else:
            f=f+1;
        one_hot_result.append(c)
    print((t/(t+f))*100);
    
    

