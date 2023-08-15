import React, { useState, useEffect } from 'react';
import CardOne from '../../components/CardOne.tsx';
import CardThree from '../../components/CardThree.tsx';
import CardTwo from '../../components/CardTwo.tsx';

interface Visitor {
    id: number;
    first_name: string;
    last_name: string;
    email: string;
    phone: string;
    vehicle_type: string;
    check_in_time: string;
    // ... other properties ...
    status: number;
}


const Dashboard: React.FC = () => {
    const apiUrl = 'http://your-api-url/api/visitors';
    const [visitors, setVisitors] = useState<Visitor[]>([]);

    useEffect(() => {
        try {
            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log(response);
                    return response.json();
                })
                .then(data => {
                    const statusOneVisitors: Visitor[] = data.data.filter((visitor: Visitor) => visitor.status === 1);
                    setVisitors(statusOneVisitors);
                })
                .catch(error => {
                    console.error('Error fetching visitors:', error);
                });
        } catch (error) {
            console.error('Error in fetch operation:', error);
        }
    }, []);

  return (
    <>
      <div className="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
        <CardOne />
        <CardTwo />
        <CardThree />
      </div>
      <div className="rounded-sm mt-5 border border-stroke bg-white px-5 pt-6 pb-2.5 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
      <h4 className="mb-6 text-xl font-semibold text-black dark:text-white">
        All Visitor
      </h4>

      <div className="flex flex-col">
        <div className="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-6">
          <div className="p-2.5 xl:p-5">
            <h5 className="text-sm font-medium uppercase">
              Name
            </h5>
          </div>
          <div className="p-2.5 text-center xl:p-5">
            <h5 className="text-sm font-medium uppercase">
              Email
            </h5>
          </div>
          <div className="p-2.5 text-center xl:p-5">
            <h5 className="text-sm font-medium uppercase">
              Phone
            </h5>
          </div>
          <div className="hidden p-2.5 text-center sm:block xl:p-5">
            <h5 className="text-sm font-medium uppercase">
              Vehicle Type
            </h5>
          </div>
          <div className="hidden p-2.5 text-center sm:block xl:p-5">
            <h5 className="text-sm font-medium uppercase">
              Checkin Time
            </h5>
          </div>
          <div className="hidden p-2.5 text-center sm:block xl:p-5">
            <h5 className="text-sm font-medium uppercase">
              Action
            </h5>
          </div>
        </div>

        { visitors.map(visitor => (
            <div className="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-6">
            <div className="flex items-center gap-3">
              <p className="hidden text-black dark:text-white sm:block">{visitor.first_name} {visitor.last_name}</p>
            </div>
  
            <div className="flex items-center justify-center">
              <p className="text-black dark:text-white">{visitor.email}</p>
            </div>
  
            <div className="flex items-center justify-center">
              <p className="text-meta-3">{visitor.phone}</p>
            </div>
  
            <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
              <p className="text-black dark:text-white">{visitor.vehicle_type}</p>
            </div>
  
            <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
              <p className="text-meta-5">{visitor.check_in_time}</p>
            </div>
  
            <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
              <button className="flex w-full justify-center rounded bg-primary p-1 font-medium text-gray">
                Checkout
              </button>
            </div>
          </div>
        ))}

        {/* <div className="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-6">
          <div className="flex items-center gap-3">
            <p className="hidden text-black dark:text-white sm:block">Mr Liam</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-black dark:text-white">liam@gmail.com</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-meta-3">+959 946693363</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-black dark:text-white">Walk In</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-meta-5">23-08-20 1AM</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <button className="flex w-full justify-center rounded bg-primary p-1 font-medium text-gray">
              Checkout
            </button>
          </div>
        </div>
        
        <div className="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-6">
          <div className="flex items-center gap-3">
            <p className="hidden text-black dark:text-white sm:block">Mr Liam</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-black dark:text-white">liam@gmail.com</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-meta-3">+959 946693363</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-black dark:text-white">Walk In</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-meta-5">23-08-20 1AM</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <button className="flex w-full justify-center rounded bg-primary p-1 font-medium text-gray">
              Checkout
            </button>
          </div>
        </div>
        
        <div className="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-6">
          <div className="flex items-center gap-3">
            <p className="hidden text-black dark:text-white sm:block">Mr Liam</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-black dark:text-white">liam@gmail.com</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-meta-3">+959 946693363</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-black dark:text-white">Walk In</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-meta-5">23-08-20 1AM</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <button className="flex w-full justify-center rounded bg-primary p-1 font-medium text-gray">
              Checkout
            </button>
          </div>
        </div>
        
        <div className="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-6">
          <div className="flex items-center gap-3">
            <p className="hidden text-black dark:text-white sm:block">Mr Liam</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-black dark:text-white">liam@gmail.com</p>
          </div>

          <div className="flex items-center justify-center">
            <p className="text-meta-3">+959 946693363</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-black dark:text-white">Walk In</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <p className="text-meta-5">23-08-20 1AM</p>
          </div>

          <div className="hidden items-center justify-center p-2.5 sm:flex xl:p-5">
            <button className="flex w-full justify-center rounded bg-primary p-1 font-medium text-gray">
              Checkout
            </button>
          </div>
        </div> */}
        
      </div>
    </div>
    </>
  );
};

export default Dashboard;
