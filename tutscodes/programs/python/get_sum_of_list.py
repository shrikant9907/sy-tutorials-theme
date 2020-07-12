# Create a custom method for calculating the sum of list items.
def get_sum_of_list(list):
	sum = 0
	for value in list:
		sum = sum + value
	return sum

# List of numbers 
list = [45, 10, 65, 12, 41, 85]

# calculate sum of list and assign to a variable sumOfList
sumOfList = sum(list)

# Display the sum on the screen.
print(sumOfList)

# Run the command: python get_sum_of_list.py
# Result will be: 258