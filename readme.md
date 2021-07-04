## Api Endpoints

1. Fetch Data for All Loans
http://localhost:8000/loans

2. Fetch Data for a particular Load (loan id)
http://localhost:8000/loans/{loan_id}



## Steps to run application
1. Go to '.env' file and set up correct DB configurations
2. Go to the Root directory in application and execute the following commands:
	2.1 php artisan migrate
	2.1 php artisan db:seed