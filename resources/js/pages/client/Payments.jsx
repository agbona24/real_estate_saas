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
    IconButton,
    useColorModeValue,
    HStack,
    VStack,
    Text,
    Select,
    Grid,
    Button,
} from '@chakra-ui/react';
import { Download, Eye, CreditCard, Calendar } from 'lucide-react';

const Payments = () => {
    const bgColor = useColorModeValue('white', 'gray.800');

    const upcomingPayments = [
        {
            id: 1,
            type: 'Mortgage Payment',
            property: '123 Main St',
            amount: 2450,
            dueDate: '2025-12-01',
            status: 'upcoming',
        },
        {
            id: 2,
            type: 'HOA Fee',
            property: '123 Main St',
            amount: 350,
            dueDate: '2025-12-01',
            status: 'upcoming',
        },
        {
            id: 3,
            type: 'Property Insurance',
            property: '789 Pine Rd',
            amount: 185,
            dueDate: '2025-12-10',
            status: 'upcoming',
        },
    ];

    const paymentHistory = [
        {
            id: 'PAY-001',
            date: '2025-11-01',
            type: 'Mortgage Payment',
            property: '123 Main St',
            amount: 2450,
            method: 'Auto-pay',
            card: '•••• 4242',
            status: 'paid',
        },
        {
            id: 'PAY-002',
            date: '2025-11-01',
            type: 'HOA Fee',
            property: '123 Main St',
            amount: 350,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
        },
        {
            id: 'PAY-003',
            date: '2025-10-15',
            type: 'Property Tax',
            property: '123 Main St',
            amount: 4500,
            method: 'Bank Transfer',
            card: 'Account •••• 5678',
            status: 'paid',
        },
        {
            id: 'PAY-004',
            date: '2025-10-10',
            type: 'Property Insurance',
            property: '789 Pine Rd',
            amount: 185,
            method: 'Auto-pay',
            card: '•••• 4242',
            status: 'paid',
        },
        {
            id: 'PAY-005',
            date: '2025-10-01',
            type: 'Mortgage Payment',
            property: '123 Main St',
            amount: 2450,
            method: 'Auto-pay',
            card: '•••• 4242',
            status: 'paid',
        },
        {
            id: 'PAY-006',
            date: '2025-10-01',
            type: 'HOA Fee',
            property: '123 Main St',
            amount: 350,
            method: 'Credit Card',
            card: '•••• 4242',
            status: 'paid',
        },
        {
            id: 'PAY-007',
            date: '2025-09-01',
            type: 'Mortgage Payment',
            property: '123 Main St',
            amount: 2450,
            method: 'Auto-pay',
            card: '•••• 4242',
            status: 'paid',
        },
    ];

    const totalUpcoming = upcomingPayments.reduce((sum, p) => sum + p.amount, 0);

    return (
        <Box>
            <HStack justify="space-between" mb={8}>
                <Heading>Payments</Heading>
                <HStack spacing={3}>
                    <Select placeholder="All properties" w="180px">
                        <option value="123-main">123 Main St</option>
                        <option value="789-pine">789 Pine Rd</option>
                    </Select>
                    <Button leftIcon={<CreditCard size={20} />} colorScheme="blue">
                        Payment Methods
                    </Button>
                </HStack>
            </HStack>

            <VStack spacing={6} align="stretch">
                {/* Upcoming Payments */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <HStack justify="space-between" mb={6}>
                        <Heading size="md">Upcoming Payments</Heading>
                        <VStack align="end" spacing={0}>
                            <Text fontSize="sm" color="gray.500">
                                Total Due
                            </Text>
                            <Text fontSize="2xl" fontWeight="bold" color="orange.600">
                                ${totalUpcoming.toLocaleString()}
                            </Text>
                        </VStack>
                    </HStack>
                    <Grid templateColumns="repeat(auto-fit, minmax(300px, 1fr))" gap={4}>
                        {upcomingPayments.map((payment) => (
                            <Box
                                key={payment.id}
                                p={5}
                                borderRadius="lg"
                                border="1px"
                                borderColor="orange.200"
                                bg="orange.50"
                                _dark={{ bg: 'orange.900', borderColor: 'orange.700' }}
                            >
                                <VStack align="start" spacing={3}>
                                    <HStack justify="space-between" w="100%">
                                        <Badge colorScheme="orange">Due Soon</Badge>
                                        <HStack spacing={1}>
                                            <Calendar size={14} />
                                            <Text fontSize="sm" fontWeight="semibold">
                                                {payment.dueDate}
                                            </Text>
                                        </HStack>
                                    </HStack>
                                    <Text fontWeight="semibold">{payment.type}</Text>
                                    <Text fontSize="sm" color="gray.600">
                                        {payment.property}
                                    </Text>
                                    <Text fontSize="2xl" fontWeight="bold" color="orange.600">
                                        ${payment.amount.toLocaleString()}
                                    </Text>
                                    <Button size="sm" colorScheme="orange" w="100%">
                                        Pay Now
                                    </Button>
                                </VStack>
                            </Box>
                        ))}
                    </Grid>
                </Box>

                {/* Payment History */}
                <Box bg={bgColor} p={6} borderRadius="xl" shadow="sm">
                    <Heading size="md" mb={6}>
                        Payment History
                    </Heading>
                    <Table variant="simple">
                        <Thead>
                            <Tr>
                                <Th>ID</Th>
                                <Th>Date</Th>
                                <Th>Type</Th>
                                <Th>Property</Th>
                                <Th>Payment Method</Th>
                                <Th>Amount</Th>
                                <Th>Status</Th>
                                <Th>Actions</Th>
                            </Tr>
                        </Thead>
                        <Tbody>
                            {paymentHistory.map((payment) => (
                                <Tr key={payment.id}>
                                    <Td fontWeight="semibold" fontSize="sm">
                                        {payment.id}
                                    </Td>
                                    <Td fontSize="sm">{payment.date}</Td>
                                    <Td fontSize="sm">{payment.type}</Td>
                                    <Td fontSize="sm">{payment.property}</Td>
                                    <Td>
                                        <VStack align="start" spacing={0}>
                                            <Text fontSize="sm">{payment.method}</Text>
                                            <Text fontSize="xs" color="gray.500">
                                                {payment.card}
                                            </Text>
                                        </VStack>
                                    </Td>
                                    <Td fontWeight="bold" color="green.600">
                                        ${payment.amount.toLocaleString()}
                                    </Td>
                                    <Td>
                                        <Badge colorScheme="green">{payment.status}</Badge>
                                    </Td>
                                    <Td>
                                        <HStack spacing={2}>
                                            <IconButton
                                                icon={<Eye size={16} />}
                                                size="sm"
                                                colorScheme="blue"
                                                variant="ghost"
                                                aria-label="View receipt"
                                            />
                                            <IconButton
                                                icon={<Download size={16} />}
                                                size="sm"
                                                colorScheme="green"
                                                variant="ghost"
                                                aria-label="Download receipt"
                                            />
                                        </HStack>
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

export default Payments;
