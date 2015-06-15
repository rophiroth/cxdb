
#!/usr/bin/python
import os.path, time
import datetime
import sys
import shutil

actual=datetime.datetime.fromtimestamp(time.time()) #actual time

files_folders = os.listdir(sys.argv[1]) # list of the folder
for file_folder in files_folders:
	full_creation_time = os.path.getmtime (sys.argv[1]+"/"+file_folder)
	creation_time=datetime.datetime.fromtimestamp(full_creation_time) #time where a folder was created
	diff=str(actual-creation_time)
	aux=diff.split(",") #extract the "day" part
	number_of_days=aux[0].split(" ") #number of days since the file or folder was created
	if ":" not in str(number_of_days[0]):
		if int(number_of_days[0])>=1: #here you can m,odify the number of days that script will take to delete files
			if os.path.isdir(sys.argv[1]+"/"+file_folder):
				shutil.rmtree(sys.argv[1]+"/"+file_folder)
			if os.path.isfile(sys.argv[1]+"/"+file_folder):
				os.remove(sys.argv[1]+"/"+file_folder)
