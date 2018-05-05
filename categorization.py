import nltk
from nltk.corpus import brown

text = ['West Ham United','Football Association', 'English', 'London', 'Bolton Wanderers', 'Wembley Stadium']
brown.categories()
cfd = nltk.ConditionalFreqDist((genre, word) for genre in brown.categories() for word in brown.words(categories=genre))
genres = ['news', 'religion', 'hobbies', 'science_fiction', 'romance', 'humor']
print(cfd.tabulate(conditions=genres, samples=text))