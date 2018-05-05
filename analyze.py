'''
Sentiment Analysis program created by Aman Adhav
'''
import nltk
import random
from textblob import TextBlob
from rake_nltk import Rake
from googleapiclient.discovery import build
import pprint
from nltk.corpus import movie_reviews
# Google API : AIzaSyBTfn4y7zrQx1vUM88tjs1dC7wetpbmDJs
class Analyze:
    '''class analyze would analyze the text and prepare the right type of slides'''
    def __init__(self, text=""):
        self._text = text
        self._sentiment_analysis = 0.0
        self._sentiment_analysis_subjectivity = 0.0
        self._ranked_words = []
        self._place_interest = []
        self._selected_images = []
        self._selected_images_url = []
    
    
    def sentiment_analysis(self)->int:
        new_analysis = TextBlob(self._text)
        '''Subjective is personal feelings vs objective is pure facts'''
        self._sentiment_analysis = new_analysis.sentiment.polarity
        self._sentiment_analysis_subjectivity = new_analysis.subjectivity
        return self._sentiment_analysis
    
    def place_interest(self) -> list:
        '''Add dictionary element to this'''
        new_text = self._text
        new_list = dict()
        for sent in nltk.sent_tokenize(new_text):
            for chunk in nltk.ne_chunk(nltk.pos_tag(nltk.word_tokenize(sent))):
                if hasattr(chunk, 'label'):
                    if (chunk.label() not in new_list):
                        new_list[chunk.label()] = ' '.join(c[0] for c in chunk).lower()
                    else:
                        temporary = [new_list[chunk.label()]]
                        temporary.append((' '.join(c[0] for c in chunk)).lower())
                        new_list[chunk.label()] = temporary
        self._place_interest = new_list
    
    def keyword_extraction(self):
        new_keyword_find = Rake()
        new_keyword_find.extract_keywords_from_text(self._text)
        ranked_words = new_keyword_find.get_ranked_phrases_with_scores()
        self._ranked_words = ranked_words        
    
    def google_search(self, **kwargs):
        my_api_key = "AIzaSyBTfn4y7zrQx1vUM88tjs1dC7wetpbmDJs"
        my_cse_id = "013938504458615515541:cmbncicbmdc"
        service = build('customsearch', "v1", developerKey=my_api_key)
        for val in self._selected_images:
            res = service.cse().list(q=val, cx=my_cse_id, searchType='image', num = 1, fileType='png', safe='off').execute()
            if not 'items' in res:
                print ('No result!!\nres is: {}'.format(res))
            else:
                for item in res['items']:
                    print('{}:\n\t{}'.format(item['title'],item['link']))
                    self._selected_images_url.append(item['link'])
                    
    
    def image_list(self):
        temporary = []
        temporary_ranked = []
        for val in self._place_interest.values():
            if type(val) == list:
                for i in val:
                    temporary.append(i)
            else:
                temporary.append(val)
        
        for val in self._ranked_words:
            temporary_ranked.append(val[1])
        self._selected_images.append(temporary_ranked[0])
        
        for val_temp in temporary:
            for val_temp_ranked in temporary_ranked:
                if val_temp in val_temp_ranked:
                    self._selected_images.append(val_temp_ranked)
        
        

      

        
        
        