
numbers = 5

def num_pyramid_one(n):
	# Number of rows	
	for i in range(1, n+1):

		# Stars
		for j in range(1, i+1):
			print(i, end = " ")

		# New Line
		print("\r")

num_pyramid_one(numbers)
# 1 
# 2 2 
# 3 3 3 
# 4 4 4 4 
# 5 5 5 5 5 


def num_pyramid_two(n):
	
	num = 1
		
	# Number of rows	
	for i in range(1, n+1):

		# Stars
		for j in range(1, i+1):
			print(num, end = " ")
			num = num + 1;

		# New Line
		print("\r")

num_pyramid_two(numbers)
# 1 
# 2 3 
# 4 5 6 
# 7 8 9 10 
# 11 12 13 14 15 

def num_pyramid_three(n):
	
	num = 65
		
	# Number of rows	
	for i in range(1, n+1):

		# Stars
		for j in range(1, i+1):
			print(chr(num), end = " ")
			num = num + 1;

		# New Line
		print("\r")

num_pyramid_three(numbers)
# A 
# B C 
# D E F 
# G H I J 
# K L M N O 

def num_pyramid_four(n):

	num = 65

	# Number of rows	
	for i in range(1, n+1):

		# Stars
		for j in range(1, i+1):
			print(chr(num), end = " ")

		num = num + 1

		# New Line
		print("\r")

num_pyramid_four(numbers)
# A 
# B B 
# C C C 
# D D D D 
# E E E E E 