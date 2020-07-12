
# Create a method to get the sum of square of numbers from 1 to N
def get_sum_of_square(n): 
	sum = 0
	for value in range(1, n+1):
		sum = sum + (value * value)
	return sum

# number is 5
num = 5

# Assign the sum to a variable
sumOfSquare = get_sum_of_square(num)

# Display the sum of square
print(sumOfSquare)

# Result will be: 55