# Print Prime Numbers
def print_prime_number(first, last):
	for value in range(first, last+1):
		if value > 1:
			for num in range(2, value):
				if value % num == 0:
					break
			else:
				print(value)

# Show Values
print_prime_number(11, 25) 