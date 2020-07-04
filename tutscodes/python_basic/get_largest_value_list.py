# Get Largest Value from Array
def get_largest_num(list):
	list_count = len(list)
	max = list[0]
	for i in range(1, list_count):
		if(list[i] > max):
			max = list[i]
	return max


def get_largest_num2(list):
	list.sort(reverse = True)
	return list[0]



list = [10, 18, 90, 58, 80]
print(get_largest_num(list))
print(get_largest_num2(list))