from gtts import gTTS
import sys


fileName = sys.argv[1]

with open("summary/%s.txt"%fileName,'r') as myFile:
    summary = myFile.read()

language = 'en'
mymp3 = gTTS(text = summary, lang = language, slow=False)
print("%s.mp3"%fileName)
mymp3.save("audio/%s.mp3"%fileName)

