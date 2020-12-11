def get_sentences(file_name):
    # Extract sentences from a text file.
    reader = open(file_name)
    sentences = reader.read()
    reader.close()
    sentences = sentences.replace("\n", "")
    sentences = convert_abbreviations(sentences)
    sentences = sentences.replace("?", ".")
    sentences = sentences.replace("!", ".")
    sentences = sentences.split(".")
    sentences = fix_broken_sentences(sentences)
    sentences = remove_whitespace_list(sentences)
    sentences = remove_blanks(sentences)
    sentences = add_periods(sentences)
    #print(sentences)
    sentences = clean_up_quotes(sentences)
    sentences = group_quotes(sentences)
    sentences = comma_handler(sentences)
    return sentences

def get_words(file_name):
    reader = open(file_name)
    words = reader.read()
    reader.close()
    words = words.replace("\n", " ")
    words = convert_abbreviations(words)
    words = words.split(" ")
    words = remove_blanks(words)
    for i in range(0, len(words)):
        words[i] = clean(words[i])
    return words

def comma_handler(sentences):
    new_list = []
    skip = False
    for i in range(0, len(sentences)):
        if skip:
            skip = False
            continue
        if i+1 < len(sentences) and sentences[i+1][0] == ",":
            new_list.append(sentences[i] + sentences[i+1])
            skip = True
        else:
            new_list.append(sentences[i])
    return new_list

def group_quotes(sentences):
    new_list = []
    skip = 0
    for i in range(0, len(sentences)):
        if skip > 0:
            skip -= 1
            continue
        sentence = sentences[i]
        while sentence.count("\"") % 2 == 1:
            skip += 1
            if i+skip >= len(sentences):
                break
            if sentences[i+skip][0].isalnum():
                sentence += " " + sentences[i+skip]
            else:
                sentence += sentences[i+skip]
        new_list.append(sentence)
    return new_list

def clean_up_quotes(sentences):
    generified = []
    for sentence in sentences:  
        sentence = sentence.replace('“', '\"')
        sentence = sentence.replace('”', '\"')
        generified.append(sentence)

    new_list = [generified[0]]
    for i in range(1, len(generified)):
        sentence = generified[i]
        isolated_quotation = generified[i][0] == "\"" and generified[i][1] == " "
        quotation_with_period = generified[i][0] == "\"" and generified[i][1] == "."
        if isolated_quotation and quotation_with_period:
            sentence = sentence[2:]
            new_list[-1] += "\""
        new_list.append(sentence)
    return new_list

def add_periods(sentences):
    new_list = []
    for sentence in sentences:
        new_list.append(sentence + ".")
    return new_list

def remove_blanks(sentences):
    new_list = []
    for sentence in sentences:
        if sentence != "":
            new_list.append(sentence)
    return new_list

def fix_broken_sentences(sentences):
    file = open("word_lists/abbreviations.txt")
    abbreviations = str(file.read()).split("\n")
    file.close()

    new_list = []
    flag = False
    for i in range(0, len(sentences)):
        if flag:
            flag = False
            continue

        last_word = sentences[i].split(" ")[-1]
        last_word = remove_punctuation(last_word)
        last_word = to_singular(last_word)
        last_word = remove_punctuation(last_word)
        last_word += "."

        new_list.append(sentences[i])
        for abbreviation in abbreviations:
            if abbreviation == last_word:
                new_list[-1] += "." + sentences[i+1]
                flag = True
                break
    return new_list

def convert_abbreviations(string):
    file = open("word_lists/abbreviations_multi.txt")
    abbreviations = str(file.read()).split("\n")
    file.close()
    new_string = string
    abbreviations_in_string = []

    for abbreviation in abbreviations:
        if abbreviation in string:
            abbreviations_in_string.append(abbreviation)
    
    abbreviations_in_string.sort(key=str.__len__)
    abbreviations_in_string.reverse()

    for abbreviation in abbreviations_in_string:
        if abbreviation in new_string:
            new_string = str(new_string).replace(abbreviation, abbreviation.replace(".", ""))
    return new_string

def clean(word):
    new_word = remove_punctuation(word)
    new_word = to_singular(new_word)
    new_word = remove_punctuation(new_word)
    new_word = str(new_word).lower()
    return new_word

def to_singular(word):
    new_word = word
    if word.endswith("'s") or word.endswith("s'"):
        new_word = word[:-2]
    elif word.endswith("ies"):
        new_word = word[:-3] + "y"
    return new_word

def remove_punctuation(word):
    new_word = word
    while new_word is not "" and not str(new_word)[0].isalnum():
        new_word = new_word[1:]
    while new_word is not "" and not str(new_word)[-1].isalnum():
        new_word = new_word[:-1]
    return new_word

def remove_whitespace_list(sentences):
    new_list = []
    for sentence in sentences:
        new_list.append(remove_whitespace(sentence))
    return new_list

def remove_whitespace(word):
    new_word = word
    while new_word is not "" and str(new_word).startswith(" "):
        new_word = new_word[1:]
    while new_word is not "" and str(new_word).endswith(" "):
        new_word = new_word[:-1]
    return new_word

def get_transition_phrases():
    lines = open("word_lists/transition_phrases.txt").readlines()
    result = []
    for line in lines:
        result.append(line.lstrip().rstrip())
    return result

def is_transition_phrase(transition_phrases, sentence):
    lower = sentence.lower()
    for phrase in transition_phrases:
        if lower.startswith(phrase):
            return True
    return False

def omit_transition_sentences(sentences):
    transition_phrases = get_transition_phrases()
    result = []
    for sentence in sentences:
        if not is_transition_phrase(transition_phrases, sentence):
            result.append(sentence)
    return result

def get_word_scores(all_words):
    file = open("word_lists/words_to_ignore.txt")
    words_to_ignore = file.read().split("\n")
    file.close()
    dictionary = {}
    for word in all_words:
        if word in words_to_ignore:
            continue
        count = 1
        if word in dictionary:
            count += dictionary.get(word)
        temp = {word: count}
        dictionary.update(temp)
    return dictionary

def score(sentence, word_scores):
    denominator = 1.0
    score = 0.0
    words = sentence.split(" ")
    for word in words:
        if word not in word_scores:
            continue
        if sentence.count(word) == 1:
            denominator += 1.0
        word = clean(word)
        score += word_scores.get(word)
    return score/denominator

def get_sentence_scores_list(all_sentences, word_scores):
    scores = []
    for sentence in all_sentences:
        scores.append(score(sentence, word_scores))
    return scores

def x_highest_score(sentence_scores, x):
    list = []
    for score in sentence_scores:
        list.append(score)
    list.sort()
    return list[-x]

def top_sentences(all_sentences, sentence_scores, threshold):
    result = []
    for i in range(0, len(all_sentences)):
        if sentence_scores[i] >= threshold:
            result.append(all_sentences[i])
    return result
