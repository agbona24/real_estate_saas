import React from 'react';
import {
    Box,
    Button,
    Heading,
    useColorModeValue,
    HStack,
    VStack,
    Text,
    Grid,
    Stat,
    StatLabel,
    StatNumber,
    StatHelpText,
    StatArrow,
    Select,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Icon,
    Flex,
} from '@chakra-ui/react';
import { Download, TrendingUp, DollarSign, Home, Users, FileText, Target } from 'lucide-react';

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
                {change !== null && (
                    <StatHelpText>
                        <StatArrow type={change > 0 ? 'increase' : 'decrease'} />
                        {Math.abs(change)}% from last period
                    </StatHelpText>
                )}
            </Stat>
        </Box>
    );
};

const Reports = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const stats = [
        { label: 'Total Revenue', value: '$125,890', change: 23, icon: DollarSign, color: 'green' },
        { label: 'Properties Sold', value: '42', change: 12, icon: Home, color: 'blue' },
        { label: 'New Clients', value: '28', change: 8, icon: Users, color: 'purple' },
        { label: 'Conversion Rate', value: '18.5%', change: 5, icon: Target, color: 'orange' },
    ];

    const realtorPerformance = [
        {
            name: 'Sarah Johnson',
            properties: 12,
            revenue: '$2.3M',
            commission: '$69,000',
            deals: 15,
            conversionRate: '22%',
        },
        {
            name: 'Michael Chen',
            properties: 10,
            revenue: '$1.9M',
            commission: '$57,000',
            deals: 12,
            conversionRate: '19%',
        },
        {
            name: 'David Kim',
            properties: 14,
            revenue: '$2.8M',
            commission: '$84,000',
            deals: 18,
            conversionRate: '24%',
        },
        {
            name: 'Jessica Martinez',
            properties: 8,
            revenue: '$1.2M',
            commission: '$36,000',
            deals: 9,
            conversionRate: '16%',
        },
    ];

    const monthlyData = [
        { month: 'June', properties: 6, revenue: '$18,500', leads: 45 },
        { month: 'July', properties: 8, revenue: '$24,200', leads: 52 },
        { month: 'August', properties: 10, revenue: '$31,800', leads: 58 },
        { month: 'September', properties: 7, revenue: '$22,100', leads: 48 },
        { month: 'October', properties: 9, revenue: '$28,900', leads: 55 },
        { month: 'November', properties: 12, revenue: '$38,400', leads: 67 },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Reports & Analytics</Heading>
                <HStack spacing={3}>
                    <Select placeholder="This Month" w="150px">
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </Select>
                    <Button leftIcon={<Download size={20} />} colorScheme="blue">
                        Export Report
                    </Button>
                </HStack>
            </HStack>

            <VStack spacing={6} align="stretch">
                {/* Key Metrics */}
                <Grid templateColumns="repeat(auto-fit, minmax(250px, 1fr))" gap={6}>
                    {stats.map((stat, index) => (
                        <StatCard key={index} {...stat} />
                    ))}
                </Grid>

                {/* Realtor Performance */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Realtor Performance
                    </Heading>
                    <Table variant="simple">
                        <Thead>
                            <Tr>
                                <Th>Realtor</Th>
                                <Th>Properties Listed</Th>
                                <Th>Total Revenue</Th>
                                <Th>Commission Earned</Th>
                                <Th>Closed Deals</Th>
                                <Th>Conversion Rate</Th>
                            </Tr>
                        </Thead>
                        <Tbody>
                            {realtorPerformance.map((realtor, index) => (
                                <Tr key={index}>
                                    <Td fontWeight="semibold">{realtor.name}</Td>
                                    <Td>{realtor.properties}</Td>
                                    <Td fontWeight="bold" color="blue.600">
                                        {realtor.revenue}
                                    </Td>
                                    <Td fontWeight="bold" color="green.600">
                                        {realtor.commission}
                                    </Td>
                                    <Td>{realtor.deals}</Td>
                                    <Td>{realtor.conversionRate}</Td>
                                </Tr>
                            ))}
                        </Tbody>
                    </Table>
                </Box>

                {/* Monthly Trends */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Monthly Trends
                    </Heading>
                    <Table variant="simple">
                        <Thead>
                            <Tr>
                                <Th>Month</Th>
                                <Th>Properties Sold</Th>
                                <Th>Revenue</Th>
                                <Th>New Leads</Th>
                            </Tr>
                        </Thead>
                        <Tbody>
                            {monthlyData.map((data, index) => (
                                <Tr key={index}>
                                    <Td fontWeight="semibold">{data.month}</Td>
                                    <Td>{data.properties}</Td>
                                    <Td fontWeight="bold" color="green.600">
                                        {data.revenue}
                                    </Td>
                                    <Td>{data.leads}</Td>
                                </Tr>
                            ))}
                        </Tbody>
                    </Table>
                </Box>

                {/* Report Types */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Available Reports
                    </Heading>
                    <Grid templateColumns="repeat(auto-fill, minmax(250px, 1fr))" gap={4}>
                        <Box p={5} borderRadius="lg" border="1px" borderColor="gray.200">
                            <HStack spacing={3} mb={3}>
                                <Icon as={FileText} color="blue.500" fontSize="24px" />
                                <VStack align="start" spacing={0}>
                                    <Text fontWeight="semibold">Sales Report</Text>
                                    <Text fontSize="sm" color="gray.500">
                                        Detailed sales analytics
                                    </Text>
                                </VStack>
                            </HStack>
                            <Button size="sm" colorScheme="blue" variant="outline" w="100%">
                                Generate
                            </Button>
                        </Box>

                        <Box p={5} borderRadius="lg" border="1px" borderColor="gray.200">
                            <HStack spacing={3} mb={3}>
                                <Icon as={Users} color="purple.500" fontSize="24px" />
                                <VStack align="start" spacing={0}>
                                    <Text fontWeight="semibold">Lead Report</Text>
                                    <Text fontSize="sm" color="gray.500">
                                        Lead conversion metrics
                                    </Text>
                                </VStack>
                            </HStack>
                            <Button size="sm" colorScheme="blue" variant="outline" w="100%">
                                Generate
                            </Button>
                        </Box>

                        <Box p={5} borderRadius="lg" border="1px" borderColor="gray.200">
                            <HStack spacing={3} mb={3}>
                                <Icon as={TrendingUp} color="green.500" fontSize="24px" />
                                <VStack align="start" spacing={0}>
                                    <Text fontWeight="semibold">Financial Report</Text>
                                    <Text fontSize="sm" color="gray.500">
                                        Revenue and commissions
                                    </Text>
                                </VStack>
                            </HStack>
                            <Button size="sm" colorScheme="blue" variant="outline" w="100%">
                                Generate
                            </Button>
                        </Box>

                        <Box p={5} borderRadius="lg" border="1px" borderColor="gray.200">
                            <HStack spacing={3} mb={3}>
                                <Icon as={Home} color="orange.500" fontSize="24px" />
                                <VStack align="start" spacing={0}>
                                    <Text fontWeight="semibold">Property Report</Text>
                                    <Text fontSize="sm" color="gray.500">
                                        Property performance data
                                    </Text>
                                </VStack>
                            </HStack>
                            <Button size="sm" colorScheme="blue" variant="outline" w="100%">
                                Generate
                            </Button>
                        </Box>
                    </Grid>
                </Box>
            </VStack>
        </Box>
    );
};

export default Reports;
