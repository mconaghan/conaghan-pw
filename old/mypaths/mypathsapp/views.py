from django.http import HttpResponse
from django.shortcuts import render_to_response, get_object_or_404
from django.template import RequestContext
from mypathsapp.models import *
from mypathsapp.forms import *
from django.views.decorators.csrf import csrf_exempt
from django.utils import timezone
import json

#TODO
month_dict = {"Jan" : 1, "Feb" : 2, "Mar" : 3, "Apr" : 4}

def home(request):
  return render_to_response('home.html', {}, context_instance=RequestContext(request))

def path(request, path_id):
  path = get_object_or_404(Path, pk=path_id)
  point_list = PathPoint.objects.filter(path=path)

  for point in point_list:
    try:
      point.photo_url = point.file.url
    except ValueError:
      point.photo_url = ""

  return render_to_response('path.html', {'point_list' : point_list}, context_instance=RequestContext(request))
 
@csrf_exempt
def upload_path(request):

  name = "no-name"

  data = request.body

  if (data == None or data == ""):
    data = "no data"
  else:
    jsonData = json.loads(data)

    title = jsonData["name"]

    path = Path.objects.create(title=title, description=title,distance=0,time_start=timezone.now(),time_end=timezone.now())
    path.save()

    for point in jsonData["points"]:
      id           = point["id"]
      battery      = int(point["battery"])
      reception    = int(point["reception"])
      distfromprev = int(point["distfromprev"])
      annotation   = point["annotation"]
      gridref      = point["gridref"]
      position     = point["position"]
      altitude     = point["altitude"]
      date         = point["date"]

      # format if date is 24 Mar 2012 10:23:21
      dateTokens = date.split("_")
      day        = int(dateTokens[0])
      month      = month_dict[dateTokens[1]]
      year       = int(dateTokens[2])
      
      timeTokens = dateTokens[3].split(":")
      hour       = int(timeTokens[0])
      minute     = int(timeTokens[1])
      second    = int(timeTokens[2])

      time = timezone.datetime(year, month, day, hour, minute, second)

      if position == "no-position-yet":
        continue
      else:
        long = float(position.split(",")[0])
        lat = float(position.split(",")[1])

      if annotation == None:
        annotation = " "

      point = PathPoint.objects.create(path=path, lon=long,lat=lat,first=False,last=False,time=time,annotation=annotation,title=gridref,battery=battery,reception=reception,altitude=altitude,dist_from_last=distfromprev)
      point.save()

  return HttpResponse("Upload-path, id: %d name: %s, data: %s" % (path.pk, title, data))

def upload_photo(request, point_id):
  point =  get_object_or_404(PathPoint, pk=point_id)

  if request.method == 'POST':
    form = DocumentForm(request.POST, request.FILES)
    if form.is_valid():
      print "!!! DEBUG !!!"
      point.file = request.FILES['docfile']
      point.save()

  return render_to_response('upload_photo.html', {}, context_instance=RequestContext(request))

def google_verify(request):
  return render_to_response('google045ba76b5db80a09.html', {}, context_instance=RequestContext(request))
