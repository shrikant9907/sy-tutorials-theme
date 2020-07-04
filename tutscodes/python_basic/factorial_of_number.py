
# Factorial Function
def factorial(n):

	if n == 1 or n == 0:
		return 1
	else:
		return n * factorial(n - 1)


# Call Factorial Function
number = 6
fact_output = factorial(number)
print(" The factorial of {0} is {1} ".format(number, fact_output))