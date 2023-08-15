import { lazy } from 'react';
import SignIn from '../pages/Authentication/SignIn';
import SignUp from '../pages/Authentication/SignUp';
const CreateVisitor = lazy(() => import('../pages/Form/CreateVisitor'));
const Profile = lazy(() => import('../pages/Profile'));

const coreRoutes = [
  {
    path: '/sign-in',
    title: 'Sign In',
    component:SignIn,
  },
  {
    path: '/sign-up',
    title: 'Sign Up',
    component:SignUp,
  },
  {
    path: '/profile',
    title: 'Profile',
    component: Profile,
  },
  {
    path: '/forms/create-visitor',
    title: 'Create Visitor',
    component: CreateVisitor,
  },
  // {
  //   path: '/forms/checkout',
  //   title: 'Checkout',
  //   component: Checkout,
  // },
  // {
  //   path: '/tables',
  //   title: 'Tables',
  //   component: Tables,
  // },
  // {
  //   path: '/settings',
  //   title: 'Settings',
  //   component: Settings,
  // },
  // {
  //   path: '/chart',
  //   title: 'Chart',
  //   component: Chart,
  // },
  // {
  //   path: '/ui/alerts',
  //   title: 'Alerts',
  //   component: Alerts,
  // },
  // {
  //   path: '/ui/buttons',
  //   title: 'Buttons',
  //   component: Buttons,
  // },
];

const routes = [...coreRoutes];
export default routes;
