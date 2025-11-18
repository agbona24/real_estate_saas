import React from 'react';
import {
    Box,
    Grid,
    Stat,
    StatLabel,
    StatNumber,
    StatHelpText,
    StatArrow,
    useColorModeValue,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    Icon,
    Flex,
    Text,
} from '@chakra-ui/react';
import { Home, Users, DollarSign, TrendingUp, UserCheck, FileText } from 'lucide-react';

const StatCard = ({ label, value, change, icon, color }) => {
    const bgColor = useColorModeValue('white', 'gray.800');

    return (
        <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
            <Stat>
                <Flex justify="space-between" align="center" mb={4}>
                    <Box p={3} bg={`${color}.50`} borderRadius="lg">
                        <Icon as={icon} color={`${color}.600`} fontSize="24px" />
                    </Box>
                </Flex>
                <StatLabel color="gray.600" fontSize="sm">
                    {label}
                </StatLabel>
                <StatNumber fontSize="3xl" fontWeight="bold">
                    {value}
                </StatNumber>
                {change && (
                    <StatHelpText>
                        <StatArrow type={change > 0 ? 'increase' : 'decrease'} />
                        {Math.abs(change)}% from last month
                    </StatHelpText>
                )}
            </Stat>
        </Box>
    );
};

const AgencyDashboard = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const stats = [
        { label: 'Active Properties', value: '234', change: 12, icon: Home, color: 'blue' },
        { label: 'Active Realtors', value: '18', change: 5, icon: Users, color: 'green' },
        { label: 'Total Revenue', value: '$125,890', change: 23, icon: DollarSign, color: 'purple' },
        { label: 'Active Leads', value: '67', change: -8, icon: TrendingUp, color: 'orange' },
        { label: 'Total Clients', value: '156', change: 15, icon: UserCheck, color: 'teal' },
        { label: 'Pending Deals', value: '12', change: 8, icon: FileText, color: 'pink' },
    ];

    const recentTransactions = [
        {
            id: 1,
            property: '123 Main St, Downtown',
            client: 'John Smith',
            realtor: 'Sarah Johnson',
            amount: '$450,000',
            status: 'completed',
            date: '2025-11-15',
        },
        {
            id: 2,
            property: '456 Oak Ave, Suburbs',
            client: 'Emily Davis',
            realtor: 'Michael Chen',
            amount: '$325,000',
            status: 'pending',
            date: '2025-11-14',
        },
        {
            id: 3,
            property: '789 Pine Rd, Lakeside',
            client: 'Robert Wilson',
            realtor: 'Sarah Johnson',
            amount: '$675,000',
            status: 'in_progress',
            date: '2025-11-12',
        },
        {
            id: 4,
            property: '321 Elm St, City Center',
            client: 'Lisa Anderson',
            realtor: 'David Kim',
            amount: '$520,000',
            status: 'completed',
            date: '2025-11-10',
        },
    ];

    return (
        <Box>
            <Heading mb={8}>Agency Dashboard</Heading>

            <Grid templateColumns="repeat(auto-fit, minmax(250px, 1fr))" gap={6} mb={8}>
                {stats.map((stat, index) => (
                    <StatCard key={index} {...stat} />
                ))}
            </Grid>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Heading size="md" mb={6}>
                    Recent Transactions
                </Heading>
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Property</Th>
                            <Th>Client</Th>
                            <Th>Realtor</Th>
                            <Th>Amount</Th>
                            <Th>Date</Th>
                            <Th>Status</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {recentTransactions.map((transaction) => (
                            <Tr key={transaction.id}>
                                <Td fontWeight="semibold">{transaction.property}</Td>
                                <Td>{transaction.client}</Td>
                                <Td>{transaction.realtor}</Td>
                                <Td fontWeight="bold" color="green.600">
                                    {transaction.amount}
                                </Td>
                                <Td>{transaction.date}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            transaction.status === 'completed'
                                                ? 'green'
                                                : transaction.status === 'pending'
                                                ? 'yellow'
                                                : 'blue'
                                        }
                                    >
                                        {transaction.status.replace('_', ' ')}
                                    </Badge>
                                </Td>
                            </Tr>
                        ))}
                    </Tbody>
                </Table>
            </Box>
        </Box>
    );
};

export default AgencyDashboard;
