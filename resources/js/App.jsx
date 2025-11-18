import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import { useAuthStore } from './stores/authStore';

// Layouts
import DashboardLayout from './layouts/DashboardLayout';
import AuthLayout from './layouts/AuthLayout';
import PublicLayout from './layouts/PublicLayout';

// Auth Pages
import Login from './pages/auth/Login';
import Register from './pages/auth/Register';
import ForgotPassword from './pages/auth/ForgotPassword';

// SaaS Owner Pages
import SaaSDashboard from './pages/saas/Dashboard';
import Agencies from './pages/saas/Agencies';
import SubscriptionPlans from './pages/saas/SubscriptionPlans';
import Themes from './pages/saas/Themes';
import GlobalSettings from './pages/saas/GlobalSettings';

// Agency Pages
import AgencyDashboard from './pages/agency/Dashboard';
import Realtors from './pages/agency/Realtors';
import Leads from './pages/agency/Leads';
import Clients from './pages/agency/Clients';
import Properties from './pages/agency/Properties';
import Transactions from './pages/agency/Transactions';
import Documents from './pages/agency/Documents';
import AgencyBranches from './pages/agency/Branches';
import AgencySettings from './pages/agency/Settings';
import WebsiteBuilder from './pages/agency/WebsiteBuilder';
import Payments from './pages/agency/Payments';
import Reports from './pages/agency/Reports';

// Realtor Pages
import RealtorDashboard from './pages/realtor/Dashboard';
import MyLeads from './pages/realtor/MyLeads';
import MyClients from './pages/realtor/MyClients';
import MyProperties from './pages/realtor/MyProperties';
import MyCommissions from './pages/realtor/MyCommissions';
import RealtorDocuments from './pages/realtor/Documents';

// Client Pages
import ClientDashboard from './pages/client/Dashboard';
import MyPurchases from './pages/client/MyPurchases';
import ClientDocuments from './pages/client/Documents';
import ClientPayments from './pages/client/Payments';
import Support from './pages/client/Support';

// Protected Route Component
const ProtectedRoute = ({ children, allowedRoles }) => {
    const { user, isAuthenticated } = useAuthStore();

    if (!isAuthenticated) {
        return <Navigate to="/login" replace />;
    }

    if (allowedRoles && !allowedRoles.includes(user?.role)) {
        return <Navigate to="/dashboard" replace />;
    }

    return children;
};

function App() {
    return (
        <Routes>
            {/* Public Routes */}
            <Route element={<PublicLayout />}>
                <Route path="/" element={<Navigate to="/dashboard" replace />} />
            </Route>

            {/* Auth Routes */}
            <Route element={<AuthLayout />}>
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/forgot-password" element={<ForgotPassword />} />
            </Route>

            {/* Protected Dashboard Routes */}
            <Route
                path="/dashboard"
                element={
                    <ProtectedRoute>
                        <DashboardLayout />
                    </ProtectedRoute>
                }
            >
                {/* Super Admin Routes */}
                <Route
                    index
                    element={
                        <ProtectedRoute allowedRoles={['super_admin']}>
                            <SaaSDashboard />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agencies"
                    element={
                        <ProtectedRoute allowedRoles={['super_admin']}>
                            <Agencies />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="subscription-plans"
                    element={
                        <ProtectedRoute allowedRoles={['super_admin']}>
                            <SubscriptionPlans />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="themes"
                    element={
                        <ProtectedRoute allowedRoles={['super_admin']}>
                            <Themes />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="settings"
                    element={
                        <ProtectedRoute allowedRoles={['super_admin']}>
                            <GlobalSettings />
                        </ProtectedRoute>
                    }
                />

                {/* Agency Admin Routes */}
                <Route
                    path="agency"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <AgencyDashboard />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/realtors"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <Realtors />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/leads"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin', 'realtor']}>
                            <Leads />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/clients"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin', 'realtor']}>
                            <Clients />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/properties"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin', 'realtor']}>
                            <Properties />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/transactions"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <Transactions />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/documents"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin', 'realtor']}>
                            <Documents />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/branches"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <AgencyBranches />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/website"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <WebsiteBuilder />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/payments"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <Payments />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/reports"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <Reports />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="agency/settings"
                    element={
                        <ProtectedRoute allowedRoles={['agency_admin']}>
                            <AgencySettings />
                        </ProtectedRoute>
                    }
                />

                {/* Realtor Routes */}
                <Route
                    path="realtor"
                    element={
                        <ProtectedRoute allowedRoles={['realtor']}>
                            <RealtorDashboard />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="realtor/leads"
                    element={
                        <ProtectedRoute allowedRoles={['realtor']}>
                            <MyLeads />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="realtor/clients"
                    element={
                        <ProtectedRoute allowedRoles={['realtor']}>
                            <MyClients />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="realtor/properties"
                    element={
                        <ProtectedRoute allowedRoles={['realtor']}>
                            <MyProperties />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="realtor/commissions"
                    element={
                        <ProtectedRoute allowedRoles={['realtor']}>
                            <MyCommissions />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="realtor/documents"
                    element={
                        <ProtectedRoute allowedRoles={['realtor']}>
                            <RealtorDocuments />
                        </ProtectedRoute>
                    }
                />

                {/* Client Routes */}
                <Route
                    path="client"
                    element={
                        <ProtectedRoute allowedRoles={['client']}>
                            <ClientDashboard />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="client/purchases"
                    element={
                        <ProtectedRoute allowedRoles={['client']}>
                            <MyPurchases />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="client/documents"
                    element={
                        <ProtectedRoute allowedRoles={['client']}>
                            <ClientDocuments />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="client/payments"
                    element={
                        <ProtectedRoute allowedRoles={['client']}>
                            <ClientPayments />
                        </ProtectedRoute>
                    }
                />
                <Route
                    path="client/support"
                    element={
                        <ProtectedRoute allowedRoles={['client']}>
                            <Support />
                        </ProtectedRoute>
                    }
                />
            </Route>

            {/* 404 */}
            <Route path="*" element={<div>404 - Not Found</div>} />
        </Routes>
    );
}

export default App;
