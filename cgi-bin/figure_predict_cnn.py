import tensorflow as tf
import numpy as np
import pickle
import sys
from PIL import Image
from PIL import ImageOps

def conv2d(x, W):
    return tf.nn.conv2d(x, W, strides=[1,1,1,1], padding='SAME')


def max_pool_2x2(x):
    return tf.nn.max_pool(x, ksize=[1,2,2,1], strides=[1,2,2,1], padding='SAME')


def max_pool_1x1(x):
    return tf.nn.max_pool(x, ksize=[1,1,1,1], strides=[1,1,1,1], padding='SAME')


x = tf.placeholder(tf.float32, [None, 900])

W_conv1 = tf.placeholder(tf.float32)
b_conv1 = tf.placeholder(tf.float32)
x_image = tf.reshape(x, [-1,30,30,1])

h_conv1 = tf.nn.relu(conv2d(x_image, W_conv1) + b_conv1)
h_pool1 = max_pool_2x2(h_conv1)

W_conv2 = tf.placeholder(tf.float32)
b_conv2 = tf.placeholder(tf.float32)
h_conv2 = tf.nn.relu(conv2d(h_pool1, W_conv2) + b_conv2)
h_pool2 = max_pool_1x1(h_conv2)

W_fc1 = tf.placeholder(tf.float32)
b_fc1 = tf.placeholder(tf.float32)

h_pool2_flat = tf.reshape(h_pool2, [-1, 15*15*64])
h_fc1 = tf.nn.relu(tf.matmul(h_pool2_flat, W_fc1))

keep_prob = tf.placeholder(tf.float32)
h_fc1_drop = tf.nn.dropout(h_fc1, keep_prob)

W_fc2 = tf.placeholder(tf.float32)
b_fc2 = tf.placeholder(tf.float32)

y_conv = tf.nn.softmax(tf.matmul(h_fc1_drop, W_fc2) + b_fc2)

prediction = tf.arg_max(y_conv, 1)

sess = tf.Session()
sess.run(tf.initialize_all_variables())

if __name__ == '__main__':

    param = sys.argv
    file_name = param[1]
    img = Image.open(file_name, 'r')
    formated_img = ImageOps.invert(ImageOps.grayscale(img.resize((30, 30))))
    image_data = np.matrix(formated_img, dtype=float).flatten() / 255

    with open('./cgi-bin/params_cnn.dump', 'rb') as f:
        params = pickle.load(f)

    result = sess.run(prediction, feed_dict={x: image_data,
                                             W_conv1: params[0],
                                             b_conv1: params[1],
                                             W_conv2: params[2],
                                             b_conv2: params[3],
                                             W_fc1: params[4],
                                             b_fc1: params[5],
                                             W_fc2: params[6],
                                             b_fc2: params[7],
                                             keep_prob: 1.0})
    prob = sess.run(y_conv, feed_dict={x: image_data,
                                       W_conv1: params[0],
                                       b_conv1: params[1],
                                       W_conv2: params[2],
                                       b_conv2: params[3],
                                       W_fc1: params[4],
                                       b_fc1: params[5],
                                       W_fc2: params[6],
                                       b_fc2: params[7],
                                       keep_prob: 1.0})
    if result == [0]:
        print('0')
        print(str(prob[0][0] * 100) + ' %')
    elif result == [1]:
        print('1')
        print(str(prob[0][1] * 100) + ' %')
