# Script used to generate data for database
# requirements: faker, pandas, pymysql, sqlalchemy
import random
from faker import Faker
import pandas
import datetime
import itertools

# Connect to MySQL 
from sqlalchemy import create_engine
engine = create_engine('mysql+pymysql://sjc353_1:sec353CC@sjc353.encs.concordia.ca/sjc353_1', echo=False)

# fake data generator
fake = Faker('en_CA')
Faker.seed(0)

# Number of people to generate
numPpl = 10
numWorkers = 4

# Number of facilities per city
numFacilities = 2

# Vaxx start and end dates
vax_start = datetime.date(2021,1,1)
vax_end = datetime.date.today()

# Dataframe to hold table to import to sql
Postal_Code = pandas.DataFrame(columns=['postal_code', 'city', 'province_code'])

# For each province 
provinces = {'NL':{'St. Johns'}, 
             'PE':{'Charlottetown'}, 
             'NS':{'Halifax'}, 
             'NB':{'Moncton'}, 
             'QC':{'Montreal', 'Quebec City', 'Laval', 'Gatineau', 'Longueuil'}, 
             'ON':{'Toronto'},
             'MB':{'Winnipeg'}, 
             'SK':{'Saskatoon'}, 
             'AB':{'Edmonton'}, 
             'BC':{'Vancouver'}, 
             'YT':{'Whitehorse'}, 
             'NT':{'Yellowknife'}, 
             'NU':{'Iqaluit'}}

# Vaccination Facilites
# Types of facilities
fac_types = ['Hospital', 'Clinic', 'Pharmacy', 'Stadium']
Vaccination_Facility = pandas.DataFrame(columns=['facility_name', 'facility_type', 'web_address', 'phone_number', 'address', 'postal_code', 'city'])

for province in provinces:
    for city in provinces.get(province):
        for _ in range(numFacilities):
            facility_type = random.choice(fac_types)    
            pc = fake.postalcode_in_province(province).replace(' ', '')
            street_name = fake.street_name()
            street_num = fake.building_number()
            facility_name = street_name + ' ' + facility_type
            Postal_Code.loc[len(Postal_Code)] = [pc, city, province]
            Vaccination_Facility.loc[len(Vaccination_Facility)] = [facility_name, 
                                                               facility_type, 
                                                               facility_name.replace(' ','') + '.com',
                                                               fake.phone_number(),
                                                               street_num + " " + street_name + " Street",
                                                               pc,
                                                               city]

# Age groups
Age_Group = pandas.DataFrame(data = [[0, 1000, 1000],
                                    [1, 80, 130],
                                    [2, 70, 79],
                                    [3, 60, 69],
                                    [4, 60, 59],
                                    [5, 40, 49],
                                    [6,30,39],
                                    [7,18,29],
                                    [8,12,17],
                                    [9,5,11],
                                    [10,0,4]],
                                    columns=['group_id', 'min_age', 'max_age'])

# Eligible Groups
Province = pandas.DataFrame(columns=['province_code', 'eligible_group_id'])
for province in provinces:
    Province.loc[len(Province)] = [province, random.randint(0,10)]
    
# Generate data for people and workers
Person = pandas.DataFrame(columns=['SSN', 'medicare', 'first_name', 'last_name', 'date_of_birth', 'email_address', 'telephone_number', 'citizenship', 'address', 'postal_code', 'city'])
HealthCare_Worker = pandas.DataFrame(columns=['SSN', 'EID'])
Works_At = pandas.DataFrame(columns=['SSN', 'facility_name', 'start_date', 'end_date'])
Manages = pandas.DataFrame(columns=['SSN', 'facility_name', 'start_date', 'end_date'])

for province in provinces:
    for city in provinces.get(province):
        # generate numPpl people per city in province 
        locations = Vaccination_Facility.loc[Vaccination_Facility['city'] == city]['facility_name'].tolist()
        it = itertools.cycle(locations)
        for x in range(numPpl):
            # next location
            location = next(it)
            # personal details
            profile = fake.profile()
            ssn = fake.ssn().replace(' ', '')
            while ssn in Person.SSN.values:
                ssn = fake.ssn().replace(' ','')
            medicare = fake.ssn().replace(' ', '')
            first = profile.get('name').split()[0]
            last = profile.get('name').split()[-1]
            dob = profile.get('birthdate')
            email = profile.get('mail')
            phone = fake.phone_number()
            citizenship = random.choice(['Canadian', 'Permanent Resident'])
            # Get random postal code
            pc = fake.postalcode_in_province(province).replace(' ', '')
            address = fake.street_address()

            # Create some healthcare workers
            if x < numWorkers:
                eid = fake.ssn().replace(' ', '')
                while eid in HealthCare_Worker.SSN.values:
                    eid = fake.ssn().replace(' ','')
                HealthCare_Worker.loc[len(HealthCare_Worker)] = [ssn, eid]

                # time worked
                between = (vax_end - vax_start).days
                start = vax_start + datetime.timedelta(days=random.randrange(between))
                between = (vax_end - vax_start).days
                end = start + datetime.timedelta(days=random.randrange(between))

                Works_At.loc[len(Works_At)] = [ssn, location, start, end] 

                # make one manager
                if x < numFacilities:
                    Manages.loc[len(Works_At)] = [ssn, location, start, end] 

            # Add the entires to the dataframe
            Person.loc[len(Person)] = [ssn, medicare, first, last, dob, email, phone, citizenship, address, pc, city]
            Postal_Code.loc[len(Postal_Code)] = [pc, city, province]

# Infections
variants = ['original', 'alpha', 'beta', 'gamma', 'delta']
Infection_Type = pandas.DataFrame(data = variants, columns=['type_of_infection'])
Infection = pandas.DataFrame(columns=['SSN', 'date_of_infection', 'type_of_infection'])

for index, row in Person.iterrows():
    start_date = datetime.date(2020, 3, 1)
    # Random number of infections per person
    numInfections = random.choices([0,1,2,3], weights=[0.80,0.10,0.05,0.05], k=1)
    for x in range(numInfections[0]):
        Infection.loc[len(Infection)] = [row['SSN'], 
                                         fake.date_between(start_date, datetime.date.today()),
                                         random.choice(variants)]

# Vaccine Type
types = ['Moderna', 'Pfizer', 'AstraZenica', 'Johnson and Johnson']

Vaccine_Type = pandas.DataFrame(data = [['Moderna','SAFE', datetime.date(2020,12,23), None], 
                                 ['Pfizer', 'SAFE', datetime.date(2020,12,9), None],
                                 ['AstraZenica', 'SAFE', datetime.date(2020,2,26), None],
                                 ['Johnson and Johnson','SUSPENDED', datetime.date(2021,3,5), datetime.date(2021,5,28)]],
                        columns=['type_name', 'status', 'date_of_approval', 'date_of_suspension'])

# Vaccinations
Vaccination = pandas.DataFrame(columns=['SSN', 'facility_name', 'type_name', 'dose_number', 'date_of_vaccination', 'Employee_SSN'])
for index, row in Person.iterrows():
    # Number of vaccinations
    numVax = random.randint(0,2)
    city = row['city']
    for x in range(numVax):
        locations = Vaccination_Facility.loc[Vaccination_Facility['city'] == city]['facility_name'].tolist()
        vax_location = random.choice(locations)
        employees = Works_At.loc[Works_At['facility_name'] == vax_location]['SSN'].tolist()
        employee = random.choice(employees)
        vax_type = random.choice(types)
        dose_number = x+1
        date_of_vaccination = fake.date_between(vax_start, vax_end)
        Vaccination.loc[len(Vaccination)] = [row['SSN'], vax_location, vax_type, dose_number, date_of_vaccination, employee]
        
# Clean up dataframes
Person = Person.drop(columns=['city'])
Vaccination_Facility = Vaccination_Facility.drop(columns=['city'])
Postal_Code = Postal_Code.drop_duplicates(subset='postal_code')

# Export to mysql db
Age_Group.to_sql('Age_Group', engine, if_exists='append', index=False, chunksize=500)
Province.to_sql('Province', engine, if_exists='append', index=False, chunksize=500)
Postal_Code.to_sql('Postal_Code', engine, if_exists='append',index=False, chunksize=500)
Infection_Type.to_sql('Infection_Type', engine, if_exists='append',index=False, chunksize=500)
Person.to_sql('Person', engine, if_exists='append',index=False, chunksize=500)
Infection.to_sql('Infection', engine, if_exists='append',index=False, chunksize=500)
HealthCare_Worker.to_sql('HealthCare_Worker', engine, if_exists='append',index=False, chunksize=500)
Vaccine_Type.to_sql('Vaccine_Type', engine, if_exists='append',index=False, chunksize=500)
Vaccination_Facility.to_sql('Vaccination_Facility', engine, if_exists='append',index=False, chunksize=500)
Works_At.to_sql('Works_At', engine, if_exists='append',index=False, chunksize=500)
Vaccination.to_sql('Vaccination', engine, if_exists='append', index=False, chunksize=500)
