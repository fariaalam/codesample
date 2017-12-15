import mnist_data as mdata
import numpy as np


x_train,x_test,y_train,y_test=mdata.getReadyData();
x_train=np.array((x_train/255), dtype=np.float64);
x_test=np.array((x_test/255), dtype=np.float64);


def softmax(x):
    x=np.exp(x);
    row,column=np.shape(x);
    for i in range(0,row):
        s=0;
        s=np.sum(x[i,:],dtype=np.float64);
        x[i,:]=x[i,:]/s;
    return x

def sigmoid(x):
    res=(1/(1+np.exp(-x)));
    return res;


input_neurons=784;
hidden_layer1_neurons=512;
hidden_layer2_neurons=256;
hidden_layer3_neurons=128;
hidden_layer4_neurons=64;
hidden_layer5_neurons=32;
output_neurons=10;
learning_rate=0.0001;
epochs=1000;


w1=np.random.randn(input_neurons,hidden_layer1_neurons);
w2=np.random.randn(hidden_layer1_neurons,hidden_layer2_neurons);
w3=np.random.randn(hidden_layer2_neurons,hidden_layer3_neurons);
w4=np.random.randn(hidden_layer3_neurons,hidden_layer4_neurons);
w5=np.random.randn(hidden_layer4_neurons,hidden_layer5_neurons);
w6=np.random.randn(hidden_layer5_neurons,output_neurons);

b1=np.random.randn(hidden_layer1_neurons);
b2=np.random.randn(hidden_layer2_neurons);
b3=np.random.randn(hidden_layer3_neurons);
b4=np.random.randn(hidden_layer4_neurons);
b5=np.random.randn(hidden_layer5_neurons);
b6=np.random.randn(output_neurons);


for i in range(1,epochs+1):
    
    a1=x_train.dot(w1)+b1;
    z1=sigmoid(a1);
    a2=z1.dot(w2)+b2;
    z2=sigmoid(a2);
    a3=z2.dot(w3)+b3;
    z3=sigmoid(a3);
    a4=z3.dot(w4)+b4;
    z4=sigmoid(a4);
    a5=z4.dot(w5)+b5;
    z5=sigmoid(a5);
    a6=z5.dot(w6)+b6;
    o=softmax(a6);

    
    error=y_train-o;
    delta_output=error*o*(1-o);
    delta_layer5=delta_output.dot(w6.T)*z5*(1-z5)
    delta_layer4=delta_layer5.dot(w5.T)*z4*(1-z4)
    delta_layer3=delta_layer4.dot(w4.T)*z3*(1-z3)
    delta_layer2=delta_layer3.dot(w3.T)*z2*(1-z2)
    delta_layer1=delta_layer2.dot(w2.T)*z1*(1-z1)

    w1+=learning_rate*x_train.T.dot(delta_layer1);
    w2+=learning_rate*z1.T.dot(delta_layer2);
    w3+=learning_rate*z2.T.dot(delta_layer3);
    w4+=learning_rate*z3.T.dot(delta_layer4);
    w5+=learning_rate*z4.T.dot(delta_layer5);
    w6+=learning_rate*z5.T.dot(delta_output);

    b1+=learning_rate*delta_layer1.sum(axis=0);
    b2+=learning_rate*delta_layer2.sum(axis=0);
    b3+=learning_rate*delta_layer3.sum(axis=0);
    b4+=learning_rate*delta_layer4.sum(axis=0);
    b5+=learning_rate*delta_layer5.sum(axis=0);
    b6+=learning_rate*delta_output.sum(axis=0);

    if i%10==0:
        print("Epoch : "+str(i)+" Loss :"+str(np.mean(np.square(error))));

def tinput(test):
    a1=x_test.dot(w1)+b1;
    z1=sigmoid(a1);
    a2=z1.dot(w2)+b2;
    z2=sigmoid(a2);
    a3=z2.dot(w3)+b3;
    z3=sigmoid(a3);
    a4=z3.dot(w4)+b4;
    z4=sigmoid(a4);
    a5=z4.dot(w5)+b5;
    z5=sigmoid(a5);
    a6=z5.dot(w6)+b6;
    o=softmax(a6);
    one_hot_result=[];
    t=0;
    f=0;
    row,column=np.shape(o);
    for i in range(0,row):
        r=o[i,:];
        r=r.tolist();
        temp=np.zeros(column);
        temp[r.index(max(r))]=1;
        one_hot_result.append(temp);
    
    for i in range(0,row):
        if y_test[i].tolist()==one_hot_result[i].tolist():
            t=t+1;
        else:
            f=f+1;
    print((t/(t+f))*100);
    print("Accuracy on test data :"+str((t/(t+f))*100));

