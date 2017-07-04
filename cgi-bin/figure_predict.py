import tensorflow as tf
import sys
from PIL import Image
from PIL import ImageOps
import numpy as np
import pickle

x = tf.placeholder(tf.float32, [1, 900])
W = tf.placeholder(tf.float32, [900, 2])
b = tf.placeholder(tf.float32, [2])
y = tf.nn.softmax(tf.matmul(x, W) + b)
prediction = tf.argmax(y, 1)

init = tf.initialize_all_variables()
sess = tf.Session()
sess.run(init)

if __name__ == '__main__':

    param = sys.argv
    file_name = param[1]
    img = Image.open(file_name, 'r')
    formated_img = ImageOps.invert(ImageOps.grayscale(img.resize((30, 30))))
    image_data = np.matrix(formated_img, dtype=float).flatten() / 255

    with open('./cgi-bin/params.dump', 'rb') as f:
        params = pickle.load(f)

    result = sess.run(prediction, feed_dict={x: image_data, W: params[0], b: params[1]})
    prob = sess.run(y, feed_dict= {x: image_data, W: params[0], b: params[1]})
    if result == [0]:
        print('0')
        print(str(prob[0][0] * 100) + ' %')
    elif result == [1]:
        print('1')
        print(str(prob[0][1] * 100) + ' %')
    #sys.stdout.write()

