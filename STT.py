#!C:\Python36\python.exe

import speech_recognition as sr
import sys

target_file = sys.argv[1]
filename = sys.argv[2]

 
AUDIO_FILE = target_file
#print(AUDIO_FILE)
 # use the audio file as the audio source
 
r = sr.Recognizer()
with sr.AudioFile(AUDIO_FILE) as source:
    #reads the audio file. Here we use record instead of
    #listen
    audio = r.record(source)

voice = r.recognize_google(audio)
text_file = open("%s.txt"%filename, "w")

text_file.write(voice)
text_file.close()
