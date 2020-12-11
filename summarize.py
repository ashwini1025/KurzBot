#!C:\Python36\python.exe

import process as p
import sys



file = sys.argv[1]
fileName = sys.argv[2]
all_words = p.get_words(file)

word_scores = p.get_word_scores(all_words)

all_sentences = p.get_sentences(file)

all_sentences = p.omit_transition_sentences(all_sentences)

sentence_scores = p.get_sentence_scores_list(all_sentences, word_scores)
maxi = len(all_sentences)
import random
r = random.randint(4,int(maxi/2))
num_of_sentences =r
if num_of_sentences > len(all_sentences):
    print("The summary cannot be longer than the text.")

threshold = p.x_highest_score(sentence_scores, num_of_sentences)

top_sentences = p.top_sentences(all_sentences,sentence_scores,threshold)

summary = ""
for sentence in top_sentences:
    summary += sentence + " "
summary = summary[:-1]

text_file = open("summary/%s.txt"%fileName, "w")
print("%s.txt"%fileName)
text_file.write(summary)
text_file.close()



