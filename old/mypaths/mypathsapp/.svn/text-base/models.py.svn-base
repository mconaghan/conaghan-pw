from django.db import models
from django import forms
from django.contrib.auth.models import User

class Path(models.Model):
  title       = models.CharField(max_length=32)
  description = models.CharField(max_length=256, blank=True)
  distance    = models.IntegerField(blank=True)
  time_start  = models.DateTimeField('time')
  time_end    = models.DateTimeField('time')

  phone       = models.CharField(max_length=32, blank=True)
  network     = models.CharField(max_length=32, blank=True)
  tags        = models.CharField(max_length=64, blank=True)

  def __unicode__(self):
    return(self.title)

class UserProfile(models.Model):
  user  = models.OneToOneField(User)
  name  = models.CharField(max_length=20)
  email = forms.EmailField()
  paths = models.ManyToManyField(Path)

  def __unicode__(self):
    return(self.name)

class PathPoint(models.Model):
  path       = models.ForeignKey(Path)
  lon        = models.FloatField()
  lat        = models.FloatField()
  altitude   = models.IntegerField()
  dist_from_last = models.IntegerField()
  file       = models.FileField(upload_to='path-photos', blank=True)
  first      = models.BooleanField()
  last       = models.BooleanField()
  time       = models.DateTimeField('time')
  annotation = models.CharField(max_length=64, blank=True)
  title      = models.CharField(max_length=10)
  battery    = models.IntegerField()
  reception  = models.IntegerField()
  music      = models.CharField(max_length=32, blank=True)

  def __unicode__(self):
    return(str(self.lon) + "," + str(self.lat))
