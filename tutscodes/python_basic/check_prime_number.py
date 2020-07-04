# Function for checking prime nber
def is_prime_number(n): 
	if n > 1: 
		for val in range(2, n):
			if n % val == 0:
				print("Not Prime", n)
				break
		else:
			print("Prime", n)
	else:
		print("Not Prime", n)

# Check Prime Number
is_prime_number(15)