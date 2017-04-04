from django.core.management.base import BaseCommand, CommandError
from mypaths.mypathsapp.models import *
from django.utils import timezone

month_dict = {"Jan" : 1, "Feb" : 2, "Mar" : 3}

class Command(BaseCommand):
    args = '<file>'
    help = 'Adds a path described in a file'

    def handle(self, *args, **options):
        if (len(args) != 1):
            self.stderr.write('No file provided\n')
        else:
            f = open(args[0])

            title = args[0].split("/")[-1].split(".")[0]
            path = Path.objects.create(title=title, description=title,distance=0,time_start=timezone.now(),time_end=timezone.now())
            path.save()

            lines = f.readlines()

            for line in lines:
                line = line.replace(",", " ")
                tokens = line.split(" ")
                title = tokens[0]

                day = int(tokens[1])
                month = month_dict[tokens[2]]
                year = int(tokens[3])

                t = tokens[4].split(":")
                hour = int(t[0])
                minute = int(t[1])
                second = int(t[2])

                position = tokens[5]
                if position == "no-position-yet":
                    continue
                else:
                    lat = float(tokens[5])
                    long = float(tokens[6])

                altitude = tokens[7].split(".")[0]
                grid_ref = tokens[8]
                distance = tokens[9]
                battery = tokens[10]
                reception = tokens[11]
 
                #TODO not in app yet
                dist_from_last = 0

                annotation = ""
                if len(tokens) > 12:
                    #strip off leading 'annotation:'
                    annotation = tokens[12][11:].replace("_", " ").rstrip()
 
                time = timezone.datetime(year, month, day, hour, minute, second)

                point = PathPoint.objects.create(path=path, lon=long,lat=lat,first=False,last=False,time=time,annotation=annotation,title=grid_ref,battery=battery,reception=reception,altitude=altitude,dist_from_last=dist_from_last)
                point.save()
                
            self.stdout.write('Successfully added path from from: %s' % args[0])
