
stars = 5

def pyramid_one(n):
	# Number of rows	
	for i in range(0, n):

		# Stars
		for j in range(0, i+1):
			print("* ", end = "")

		# New Line
		print("\r")

pyramid_one(stars)
# * 
# * * 
# * * * 
# * * * * 
# * * * * * 

def pyramid_two(n):

	# Number of rows
	for i in range(0,n):

		# Spaces
		k = 2*(n-i)-2	
		for j in range(0, k):
			print(end=" ")
		
		# Stars
		for l in range(0, i+1):
			print("*", end=" ")

		print("\r")

pyramid_two(stars)
#         * 
#       * * 
#     * * * 
#   * * * * 
# * * * * * 

def pyramid_three(n): 

	# Number of rows
	for i in range(0,n):

		# Spaces
		k = (n-i)-1	
		for j in range(0, k):
			print(end=" ")
		
		# Stars
		for l in range(0, i+1):
			print("*", end=" ")

		print("\r")

pyramid_three(stars)
#     * 
#    * * 
#   * * * 
#  * * * * 
# * * * * * 