#!/usr/bin/env python
import os, sys

sys.path.append("/var/www")
sys.path.append("/var/www/mypaths")
sys.path.append("/var/www/mypath/mypathsapp")
sys.path.append("/var/www/mypath/mypathsapp/management")

if __name__ == "__main__":
    os.environ.setdefault("DJANGO_SETTINGS_MODULE", "mypaths.settings")

    from django.core.management import execute_from_command_line

    execute_from_command_line(sys.argv)
