# number
number = 6

# Factorial Method
def getFactorial(n):
	if n < 2:
		return 1
	else:
		return n * getFactorial(n - 1)

# Call Factorial Method
factorial = getFactorial(number)

# Display result
print(" The factorial of {0} is {1} ".format(number, factorial))