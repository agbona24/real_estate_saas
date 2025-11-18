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
} from '@chakra-ui/react';
import { Building2, Users, DollarSign, TrendingUp } from 'lucide-react';

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
                        {Math.abs(change)}%
                    </StatHelpText>
                )}
            </Stat>
        </Box>
    );
};

const SaaSDashboard = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    // Demo data
    const stats = [
        { label: 'Total Agencies', value: '156', change: 12, icon: Building2, color: 'blue' },
        { label: 'Active Users', value: '2,450', change: 8, icon: Users, color: 'green' },
        { label: 'Monthly Revenue', value: '$45,890', change: 15, icon: DollarSign, color: 'purple' },
        { label: 'Growth Rate', value: '23.5%', change: 5, icon: TrendingUp, color: 'orange' },
    ];

    const recentAgencies = [
        { id: 1, name: 'Prime Realty', email: 'contact@primerealty.com', plan: 'Professional', status: 'active' },
        { id: 2, name: 'Urban Estates', email: 'info@urbanestates.com', plan: 'Enterprise', status: 'active' },
        { id: 3, name: 'Coastal Properties', email: 'hello@coastal.com', plan: 'Basic', status: 'trial' },
        { id: 4, name: 'Metro Housing', email: 'support@metrohousing.com', plan: 'Professional', status: 'active' },
    ];

    return (
        <Box>
            <Heading mb={8}>SaaS Dashboard</Heading>

            <Grid templateColumns="repeat(auto-fit, minmax(250px, 1fr))" gap={6} mb={8}>
                {stats.map((stat, index) => (
                    <StatCard key={index} {...stat} />
                ))}
            </Grid>

            <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                <Heading size="md" mb={6}>
                    Recent Agencies
                </Heading>
                <Table variant="simple">
                    <Thead>
                        <Tr>
                            <Th>Agency Name</Th>
                            <Th>Email</Th>
                            <Th>Plan</Th>
                            <Th>Status</Th>
                        </Tr>
                    </Thead>
                    <Tbody>
                        {recentAgencies.map((agency) => (
                            <Tr key={agency.id}>
                                <Td fontWeight="semibold">{agency.name}</Td>
                                <Td>{agency.email}</Td>
                                <Td>{agency.plan}</Td>
                                <Td>
                                    <Badge
                                        colorScheme={
                                            agency.status === 'active'
                                                ? 'green'
                                                : agency.status === 'trial'
                                                ? 'blue'
                                                : 'red'
                                        }
                                    >
                                        {agency.status}
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

// Import Flex at the top
import { Flex } from '@chakra-ui/react';

export default SaaSDashboard;
