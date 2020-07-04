# Simple Interest function
def get_simple_interest(p, r, t):
	si = (p * r * t) / 100
	return si


# Calculating simple interest
P = 1000
R = 5
T = 12
SI = get_simple_interest(P, R, T)
print("The Simple Interest Is: {0}".format(SI))