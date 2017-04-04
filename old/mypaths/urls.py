from django.conf.urls import patterns, include, url

# Uncomment the next two lines to enable the admin:
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
    url(r'^$', 'mypaths.mypathsapp.views.home', name='home'),
    url(r'^path/(?P<path_id>\d+)/$', 'mypaths.mypathsapp.views.path', name='path'),
    url(r'^upload-photo/(?P<point_id>\d+)/$', 'mypaths.mypathsapp.views.upload_photo', name='upload_photo'),
    url(r'^upload-path/$', 'mypaths.mypathsapp.views.upload_path', name='upload_path'),
    url(r'^google045ba76b5db80a09.html$', 'mypaths.mypathsapp.views.google_verify', name='google_verify'),

    # Uncomment the admin/doc line below to enable admin documentation:
    # url(r'^admin/doc/', include('django.contrib.admindocs.urls')),

    # Uncomment the next line to enable the admin:
    url(r'^admin/', include(admin.site.urls)),
)
