# function for compound interest
def get_compound_interest(p, r, t):
	ci = p * ( pow( (1 + r / 100), t) )
	return ci


# Print compound interest
P = 1000
R = 2
T = 5
CI = get_compound_interest(P, R, T)
print("Compound Interest Is ", CI)
