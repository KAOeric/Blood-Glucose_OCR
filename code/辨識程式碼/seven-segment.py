"""
Simply display the contents of the webcam with optional mirroring using OpenCV
via the new Pythonic cv2 interface.  Press <esc> to quit.
"""
import sys
import os
import Tkinter
import cv2
import time
import numpy as np
import ConfigParser
import httplib,urllib,urllib2

top=Tkinter.Tk()

h_start = 200
w_length = 18
h_end = 295
h_length = 160

dW = int(w_length * 2 / 3)
dH = 19

areas = np.zeros(15)
np_imgclip = np.empty(15)
s=[]
out_string =['X','X','X']

n_code={
        1: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1],
        2: [0, 0, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 0, 1],
        3: [1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1],
        4: [1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1],
        5: [1, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1],
        6: [1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1],
        7: [1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1],
        8: [1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1],
        9: [1, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1],
        0: [1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1]
        }

config = ConfigParser.ConfigParser()
configpath = r'/Users/Q/Desktop/Python Project/TH-SEND-WEB/config.ini'
config.read(configpath)
config.read(configpath)

ini_ma_no = config.get('Rpi', 'Machine_ID')
ini_dalay_sec = float(config.get('Rpi', 'Time_Interval'))
ini_tty_timeout = float(config.get('Rpi', 'tty_Timeout'))
ini_pwd = config.get('Server', 'Password')
ini_url = config.get('Server', 'URL')
ini_timeout = float(config.get('Server', 'Timeout'))


def Draw_Lines(img):

    gray_origin = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # cv2.imshow('clone webcam', gray_origin)

    cv2.rectangle(img, (238, h_start), (274, h_end), (0, 0, 255), 3)
    cv2.rectangle(img, (290, h_start), (326, h_end), (0, 0, 255), 3)
    cv2.rectangle(img, (344, h_start), (380, h_end), (0, 0, 255), 3)

    # Draw Lines to Width segments

    cv2.line(img, (250, h_start), (250, h_end), (255, 255, 255), 1)
    cv2.line(img, (262, h_start), (262, h_end), (255, 255, 255), 1)

    cv2.line(img, (302, h_start), (302, h_end), (255, 255, 255), 1)
    cv2.line(img, (314, h_start), (314, h_end), (255, 255, 255), 1)

    cv2.line(img, (356, h_start), (356, h_end), (255, 255, 255), 1)
    cv2.line(img, (368, h_start), (368, h_end), (255, 255, 255), 1)

    # Draw Lines to Height segments
    cv2.line(img, (238, h_start + dH), (274, h_start + dH), (0, 255, 0), 1)
    cv2.line(img, (238, h_start + dH * 2), (274, h_start + dH * 2), (0, 255, 0), 1)
    cv2.line(img, (238, h_start + dH * 3), (274, h_start + dH * 3), (0, 255, 0), 1)
    cv2.line(img, (238, h_start + dH * 4), (274, h_start + dH * 4), (0, 255, 0), 1)

    cv2.line(img, (290, h_start + dH), (326, h_start + dH), (0, 255, 0), 1)
    cv2.line(img, (290, h_start + dH * 2), (326, h_start + dH * 2), (0, 255, 0), 1)
    cv2.line(img, (290, h_start + dH * 3), (326, h_start + dH * 3), (0, 255, 0), 1)
    cv2.line(img, (290, h_start + dH * 4), (326, h_start + dH * 4), (0, 255, 0), 1)

    cv2.line(img, (344, h_start + dH), (380, h_start + dH), (0, 255, 0), 1)
    cv2.line(img, (344, h_start + dH * 2), (380, h_start + dH * 2), (0, 255, 0), 1)
    cv2.line(img, (344, h_start + dH * 3), (380, h_start + dH * 3), (0, 255, 0), 1)
    cv2.line(img, (344, h_start + dH * 4), (380, h_start + dH * 4), (0, 255, 0), 1)

    cv2.imshow('my webcam', img)

    return gray_origin

def Image_Segment0(gray_origin):

        # gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        # cv2.imshow('Grayed', gray)

        xs = 320 - w_length
        xw = w_length
        ys = h_start
        yh = h_end - h_start
        # crop_img = img[h_start: (h_end - h_start), (320 - w_length): w_length*2]
        # crop_img = gray[int(ys):int(yh), int(xs):int(xw)]
        crop_img = gray_origin[int(h_start): int(h_end), int(344): int(380)]
        # crop_img = gray[210:270, 200:280]
        #cv2.imshow('Cropped-------0', crop_img)
        eq = cv2.equalize(crop_img)

        _, thresh2 = cv2.threshold(crop_img, 100, 225, cv2.THRESH_BINARY_INV)
        #cv2.imshow('Binaries------0', thresh2)

        t_01 = thresh2[0:95, 0:36]
        img_rs = cv2.resize(t_01, None, fx=8.0, fy=8.0)
        #cv2.imshow('t_01', img_rs)

        if cv2.waitKey(1) == ord('s'):
            cv2.imwrite('waka.jpg', thresh2)
            print('File saved.....')

        return thresh2

def Image_Segment1(gray_origin):

        # gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        # cv2.imshow('Grayed', gray)

            xs = 320 - w_length
            xw = w_length
            ys = h_start
            yh = h_end - h_start
            # crop_img = img[h_start: (h_end - h_start), (320 - w_length): w_length*2]
            # crop_img = gray[int(ys):int(yh), int(xs):int(xw)]
            crop_img = gray_origin[int(h_start): int(h_end), int(290): int(326)]
            # crop_img = gray[210:270, 200:280]
            #cv2.imshow('Cropped-----------1', crop_img)
            eq = cv2.equalize(crop_img)
            _ , thresh2= cv2.threshold(crop_img, 100, 225, cv2.THRESH_BINARY_INV)
            #cv2.imshow('Binaries----------1', thresh2)

            t_01 = thresh2[0:95, 0:36]
            img_rs = cv2.resize(t_01, None, fx=8.0, fy=8.0)
            #cv2.imshow('t_01', img_rs)

            if cv2.waitKey(1) == ord('s'):
                cv2.imwrite('waka.jpg',thresh2 )
                print('File saved.....')


            return thresh2


def Image_Segment2(gray_origin):
        # gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        # cv2.imshow('Grayed', gray)

            xs = 320 - w_length
            xw = w_length
            ys = h_start
            yh = h_end - h_start
        # crop_img = img[h_start: (h_end - h_start), (320 - w_length): w_length*2]
        # crop_img = gray[int(ys):int(yh), int(xs):int(xw)]
            crop_img = gray_origin[int(h_start): int(h_end), int(238): int(274)]
        # crop_img = gray[210:270, 200:280]
        #cv2.imshow('Cropped-------2', crop_img)
            eq = cv2.equalize(crop_img)
            _, thresh2 = cv2.threshold(crop_img, 100, 225, cv2.THRESH_BINARY_INV)
        #cv2.imshow('Binaries------2', thresh2)

            t_01 = thresh2[0:95, 0:36]
            img_rs = cv2.resize(t_01, None, fx=8.0, fy=8.0)
        #cv2.imshow('t_01', img_rs)

            if cv2.waitKey(1) == ord('s'):
                cv2.imwrite('waka.jpg', thresh2)
                print('File saved.....')

            return thresh2


###

def post_server(mg):
    data = {'ma_no': ini_ma_no, 'mg': mg, 'password': ini_pwd}
    ress = urllib2.urlopen(
        url=ini_url,
        data=urllib.urlencode(data),
        timeout=ini_timeout
    )

def recognize_number(img,i):
    for x in range(0, 3):
        for y in range(0, 5):
            imgclip_piece = img[dH * (y):dH * (y + 1), dW * (x):dW * (x + 1)]

            count = cv2.countNonZero(imgclip_piece)

            if count <= 30:
                area = 0
            elif count > 30:
                area = 1

            ac = 5 * x + y
            areas[ac] = area



            img_rs = cv2.resize(imgclip_piece, None, fx=16.0, fy=16.0)
            # cv2.imshow('Clip_piece', img_rs)
            # cv2.waitKey(100)
            #print("imgclip[%d}=[%d:%d,%d:%d],[%d,%d],count=%d,area=%d" % (5 * x + y, dH * y, dH * (y + 1), dW * x, dW * (x + 1), x, y, count, area))

    # time.sleep(1)

    # for p in range (0,14):
    s = areas.tolist()

    #print('%s' % s)

    x = None  # Searched key
    for k, v in n_code.items():
        if v == s:
            x = k
            digit_number = x * 10**i
            #print('The digit = %d' % digit_number)
            out_string[i] = str(x)
            #print('s100=%s'% s100)
            break
        else:
            out_string[i] = '-'
            if i == 2:
                count2 = cv2.countNonZero(img)
                if count2 <= 50:
                    out_string[2] = 'X'
            print('s100=%s , s10=%s, s1=%s' % (out_string[2], out_string[1], out_string[0]))

def post():
    global GLU2
    while True:
        try:
            post_server(GLU2)
            break


#######
def main():
    # show_webcam(mirror=False)

    cam = cv2.VideoCapture(0)
    global GLU2
    while True:
        ret_val, img = cam.read()
        grayed_img = Draw_Lines(img)
        #cv2.imshow('clone webcam', img)
        # img = read_number_image('n06.jpg')

        seg_img = Image_Segment0(grayed_img)
        recognize_number(seg_img,0)

        seg_img = Image_Segment1(grayed_img)
        recognize_number(seg_img, 1)

        seg_img = Image_Segment2(grayed_img)
        recognize_number(seg_img, 2)

        if out_string[2] == '-' or out_string[1] == '-' or out_string[0] == '-':
            print('Not post')
        elif out_string[2] == 'X':
            GLU2 = out_string[1] + out_string[0]
            print('The Numerical value=%s' % GLU2)
        else:
            GLU2 = out_string[2] + out_string[1] + out_string[0]
            print('The Numerical value=%s' % GLU2)

            break # esc to quit

B=Tkinter.Button(top,text="OpenCamera",command=main, height=3, width=12)
B.pack()
A=Tkinter.Button(top,text="UpLoad",command=post, height=3, width=12)
A.pack()
top.mainloop()

if __name__ == '__main__':
    main()

