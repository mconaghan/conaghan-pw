import os
import sys
 
path = '/var/www'
if path not in sys.path:
    sys.path.insert(0, '/var/www/')
    sys.path.insert(0, '/var/www/mypaths')
    sys.path.insert(0, '/var/www/mypaths/mypathsapp')
 
os.environ['DJANGO_SETTINGS_MODULE'] = 'mypaths.settings'
 
import django.core.handlers.wsgi
application = django.core.handlers.wsgi.WSGIHandler()
