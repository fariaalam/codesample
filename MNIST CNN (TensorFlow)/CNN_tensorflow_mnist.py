import tensorflow as tf
import numpy as np
from sklearn.metrics import confusion_matrix

from tensorflow.examples.tutorials.mnist import input_data
data = input_data.read_data_sets('data/MNIST/', one_hot=True)

filter_size1=5
num_filters1=16
filter_size2=5
num_filters2=36
fc_size = 1024  
img_size=28
img_size_flat=28*28
img_shape=(28*28)
num_channels=1
num_classes=10
train_batch_size = 64
test_batch_size = 64
data.test.cls = np.argmax(data.test.labels, axis=1)

def pooling_layer(layer):
    pool_layer = tf.nn.max_pool(value=layer,
                               ksize=[1, 2, 2, 1],
                               strides=[1, 2, 2, 1],
                               padding='SAME')
    return pool_layer;

def relu_layer(layer):
    relulayer= tf.nn.relu(layer);
    return relulayer;

def nn_weights(shape):
    weights=tf.Variable(tf.truncated_normal(shape, stddev=0.05));
    return weights;

def nn_biases(length):
    biases=tf.Variable(tf.constant(0.05,shape=[length]))
    return biases;

def conv_layer(input, num_input_channels, filter_size, num_filters):  
    shape = [filter_size, filter_size, num_input_channels, num_filters]
    weights = nn_weights(shape=shape)
    biases = nn_biases(length=num_filters)
    layer = tf.nn.conv2d(input=input,
                         filter=weights,
                         strides=[1, 1, 1, 1],
                         padding='SAME')
    layer += biases
    return layer

def flat_layer(layer):
    layer_shape = layer.get_shape()
    num_features = layer_shape[1:4].num_elements()
    layer_flat = tf.reshape(layer, [-1, num_features])
    return layer_flat, num_features

def fc_layer(input, num_inputs,num_outputs): 
    weights = nn_weights(shape=[num_inputs, num_outputs])
    biases = nn_biases(length=num_outputs)
    layer = tf.matmul(input, weights) + biases
    return layer

def train_cnn(epochs):
    
    for i in range(0,epochs):
        x_train_batch, y_train_batch = data.train.next_batch(train_batch_size)
        feed_dict_train = {x: x_train_batch, y_true: y_train_batch}
        session.run(optimizer, feed_dict=feed_dict_train)
        if i % 100 == 0:
            acc = session.run(accuracy, feed_dict=feed_dict_train)
            print("Epoch : "+str(i+1)+" Accuracy : "+str(acc));
    

def test_on_data():
    test_images = len(data.test.images)
    cls_pred = np.zeros(shape=test_images, dtype=np.int)
    i = 0
    while i < test_images:
        j = min(i + test_batch_size, test_images)
        x_test_batch = data.test.images[i:j, :]
        y_test_batch= data.test.labels[i:j, :]
        feed_dict = {x: x_test_batch, y_true: y_test_batch}
        cls_pred[i:j] = session.run(y_pred_cls, feed_dict=feed_dict)
        i = j
    cls_true = data.test.cls
    only_correct_samples = (cls_true == cls_pred)
    correct_samples = only_correct_samples.sum()
    acc = float(correct_samples) / test_images
    print("Accuracy on test set : "+str(acc)+" ("+str(correct_samples)+"/ "+str(test_images)+")");
    

x = tf.placeholder(tf.float32, shape=[None, img_size_flat], name='x')
x_image = tf.reshape(x, [-1, img_size, img_size, num_channels])
y_true = tf.placeholder(tf.float32, shape=[None, num_classes], name='y_true')
y_true_cls = tf.argmax(y_true, dimension=1)

conv1= conv_layer(input=x_image,
                   num_input_channels=num_channels,
                   filter_size=filter_size1,
                   num_filters=num_filters1)

pool1=pooling_layer(conv1);
relulayer1 = relu_layer(pool1);

conv2= conv_layer(input=relulayer1,
                   num_input_channels=num_filters1,
                   filter_size=filter_size2,
                   num_filters=num_filters2)

pool2=pooling_layer(conv2);
relulayer2 = relu_layer(pool2);

flat_layer, num_features = flat_layer(relulayer2);

fc_layer1 = fc_layer(input=flat_layer,
                         num_inputs=num_features,
                         num_outputs=fc_size)

fc_layer1_relu=relu_layer(fc_layer1);

fc_layer2 = fc_layer(input=fc_layer1_relu,
                         num_inputs=fc_size,
                         num_outputs=num_classes)

y_pred = tf.nn.softmax(fc_layer2)

y_pred_cls = tf.argmax(y_pred, dimension=1)

cross_entropy = tf.nn.softmax_cross_entropy_with_logits(logits=fc_layer2,
                                                        labels=y_true)

cost = tf.reduce_mean(cross_entropy)
optimizer = tf.train.AdamOptimizer(learning_rate=1e-4).minimize(cost)
correct_prediction = tf.equal(y_pred_cls, y_true_cls)
accuracy = tf.reduce_mean(tf.cast(correct_prediction, tf.float32))
session = tf.Session()
session.run(tf.global_variables_initializer())


if __name__=="__main__":
    epochs=int(input("Please enter the number of epochs: "));
    train_cnn(epochs);
    test_on_data();
    
