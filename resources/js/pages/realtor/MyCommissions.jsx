import React from 'react';
import {
    Box,
    Heading,
    Table,
    Thead,
    Tbody,
    Tr,
    Th,
    Td,
    Badge,
    useColorModeValue,
    HStack,
    VStack,
    Text,
    Grid,
    Stat,
    StatLabel,
    StatNumber,
    StatHelpText,
    Icon,
    Flex,
    Select,
} from '@chakra-ui/react';
import { DollarSign, TrendingUp, Award, Calendar } from 'lucide-react';

const StatCard = ({ label, value, description, icon, color }) => {
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
                {description && <StatHelpText>{description}</StatHelpText>}
            </Stat>
        </Box>
    );
};

const MyCommissions = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const stats = [
        {
            label: 'Total Earned',
            value: '$69,000',
            description: 'Lifetime earnings',
            icon: DollarSign,
            color: 'green',
        },
        {
            label: 'This Year',
            value: '$32,500',
            description: '15 deals closed',
            icon: TrendingUp,
            color: 'blue',
        },
        {
            label: 'This Month',
            value: '$4,500',
            description: '2 deals closed',
            icon: Award,
            color: 'purple',
        },
        {
            label: 'Pending',
            value: '$8,250',
            description: '3 deals in progress',
            icon: Calendar,
            color: 'orange',
        },
    ];

    const commissions = [
        {
            id: 'COM-001',
            property: '123 Main St, Downtown',
            client: 'John Smith',
            salePrice: 450000,
            commissionRate: 3,
            totalCommission: 13500,
            yourSplit: 60,
            yourCommission: 8100,
            date: '2025-11-15',
            status: 'paid',
            paymentDate: '2025-11-20',
        },
        {
            id: 'COM-002',
            property: '456 Oak Ave, Suburbs',
            client: 'Emily Davis',
            salePrice: 325000,
            commissionRate: 3,
            totalCommission: 9750,
            yourSplit: 60,
            yourCommission: 5850,
            date: '2025-10-28',
            status: 'paid',
            paymentDate: '2025-11-05',
        },
        {
            id: 'COM-003',
            property: '789 Pine Rd, Lakeside',
            client: 'Robert Wilson',
            salePrice: 675000,
            commissionRate: 3,
            totalCommission: 20250,
            yourSplit: 60,
            yourCommission: 12150,
            date: '2025-10-15',
            status: 'pending',
            paymentDate: null,
        },
        {
            id: 'COM-004',
            property: '321 Elm St, City Center',
            client: 'Lisa Anderson',
            salePrice: 520000,
            commissionRate: 3,
            totalCommission: 15600,
            yourSplit: 60,
            yourCommission: 9360,
            date: '2025-09-20',
            status: 'paid',
            paymentDate: '2025-09-25',
        },
        {
            id: 'COM-005',
            property: '654 Maple Dr, East Side',
            client: 'Mark Thompson',
            salePrice: 275000,
            commissionRate: 3,
            totalCommission: 8250,
            yourSplit: 60,
            yourCommission: 4950,
            date: '2025-08-12',
            status: 'paid',
            paymentDate: '2025-08-18',
        },
        {
            id: 'COM-006',
            property: '987 Tower Blvd, Financial District',
            client: 'Sarah Miller',
            salePrice: 950000,
            commissionRate: 3,
            totalCommission: 28500,
            yourSplit: 60,
            yourCommission: 17100,
            date: '2025-11-18',
            status: 'processing',
            paymentDate: null,
        },
    ];

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>My Commissions</Heading>
                <Select placeholder="This Year" w="150px">
                    <option value="month">This Month</option>
                    <option value="quarter">This Quarter</option>
                    <option value="year">This Year</option>
                    <option value="all">All Time</option>
                </Select>
            </HStack>

            <VStack spacing={6} align="stretch">
                {/* Stats */}
                <Grid templateColumns="repeat(auto-fit, minmax(250px, 1fr))" gap={6}>
                    {stats.map((stat, index) => (
                        <StatCard key={index} {...stat} />
                    ))}
                </Grid>

                {/* Commissions Table */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Commission History
                    </Heading>
                    <Table variant="simple">
                        <Thead>
                            <Tr>
                                <Th>ID</Th>
                                <Th>Property</Th>
                                <Th>Client</Th>
                                <Th>Sale Price</Th>
                                <Th>Total Commission</Th>
                                <Th>Your Split</Th>
                                <Th>Your Commission</Th>
                                <Th>Date</Th>
                                <Th>Status</Th>
                            </Tr>
                        </Thead>
                        <Tbody>
                            {commissions.map((commission) => (
                                <Tr key={commission.id}>
                                    <Td fontWeight="semibold" fontSize="sm">
                                        {commission.id}
                                    </Td>
                                    <Td fontSize="sm">{commission.property}</Td>
                                    <Td fontSize="sm">{commission.client}</Td>
                                    <Td fontWeight="bold" color="blue.600">
                                        ${commission.salePrice.toLocaleString()}
                                    </Td>
                                    <Td fontSize="sm">${commission.totalCommission.toLocaleString()}</Td>
                                    <Td fontSize="sm">{commission.yourSplit}%</Td>
                                    <Td fontWeight="bold" color="green.600">
                                        ${commission.yourCommission.toLocaleString()}
                                    </Td>
                                    <Td fontSize="sm">
                                        <VStack align="start" spacing={0}>
                                            <Text>{commission.date}</Text>
                                            {commission.paymentDate && (
                                                <Text fontSize="xs" color="gray.500">
                                                    Paid: {commission.paymentDate}
                                                </Text>
                                            )}
                                        </VStack>
                                    </Td>
                                    <Td>
                                        <Badge
                                            colorScheme={
                                                commission.status === 'paid'
                                                    ? 'green'
                                                    : commission.status === 'processing'
                                                    ? 'blue'
                                                    : 'yellow'
                                            }
                                        >
                                            {commission.status}
                                        </Badge>
                                    </Td>
                                </Tr>
                            ))}
                        </Tbody>
                    </Table>
                </Box>
            </VStack>
        </Box>
    );
};

export default MyCommissions;
